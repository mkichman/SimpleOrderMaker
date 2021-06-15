<?php


namespace App;


use App\Events\OrderCreated;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

class Order extends EventSourcedAggregateRoot
{

    private string $id;

    private int $productId;
    private int $colorId;
    private int $deliveryId;

    public static function create(string $id, int $productId, int $colorId, int $deliveryId)
    {
        $order = new self();

        $order->apply(
            new OrderCreated($id, $productId, $colorId, $deliveryId)
        );

        return $order;
    }


    public function getAggregateRootId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getColorId(): int
    {
        return $this->colorId;
    }

    /**
     * @return int
     */
    public function getDeliveryId(): int
    {
        return $this->deliveryId;
    }

    protected function applyOrderCreated(OrderCreated $event): void
    {
        $this->id           = $event->id;
        $this->productId    = $event->productId;
        $this->colorId      = $event->colorId;
        $this->deliveryId   = $event->deliveryId;
    }
}
