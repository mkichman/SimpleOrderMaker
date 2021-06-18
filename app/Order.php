<?php


namespace App;

use App\Domain\Interfaces\OrderDomainInterface;
use App\Events\OrderCreated;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

class Order extends EventSourcedAggregateRoot implements OrderDomainInterface
{
    private int $productId;
    private int $deliveryId;

    public static function create(int $productId, int $deliveryId)
    {
        $order = new self();
        $order->apply(
            new OrderCreated($productId, $deliveryId)
        );
        return $order;
    }

    public function getAggregateRootId(): string
    {
        return (string)mt_rand();
    }

    public function getId()
    {
        return $this->getAggregateRootId();
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
    public function getDeliveryId(): int
    {
        return $this->deliveryId;
    }

    protected function applyOrderCreated(OrderCreated $event): void
    {
        $this->productId    = $event->productId;
        $this->deliveryId   = $event->deliveryId;
    }
}
