<?php


namespace App;


use App\Events\DeliverySelected;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Broadway\ReadModel\Identifiable;

class Delivery extends EventSourcedAggregateRoot implements Identifiable
{
    private string $id;
    public static function create($id)
    {
        $product = new self();
        $product->apply(
            new DeliverySelected($id));

        return $product;
    }

    protected function applyDeliverySelected(DeliverySelected $event): void
    {
        $this->id           = $event->id;
    }

    public function getAggregateRootId(): string
    {
        return $this->id;
    }

    public function getId(): string
    {
        return $this->getAggregateRootId();
    }
}
