<?php


namespace App\Projectors;


use App\Delivery;
use App\Events\DeliverySelected;
use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;

class DeliveryProjector extends Projector
{
    public function __construct(public Repository $repository) { }

    protected function applyDeliverySelected(DeliverySelected $deliverySelected): void
    {
        $delivery = Delivery::create(
            $deliverySelected->id
        );

        $this->repository->save($delivery);
    }
}
