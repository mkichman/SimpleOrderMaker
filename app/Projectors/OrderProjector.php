<?php


namespace App\Projectors;


use App\Events\OrderCreated;
use App\Order;
use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;

class OrderProjector extends Projector
{
    public function __construct(public Repository $repository) { }

    protected function applyOrderWasCreatedEvent(OrderCreated $orderCreated): void
    {
        $order = Order::create(
            $orderCreated->id,
            $orderCreated->productId,
            $orderCreated->deliveryId
        );

        $this->repository->save($order);
    }

    public function printOrderItems()
    {
        dd($this->repository);
    }
}
