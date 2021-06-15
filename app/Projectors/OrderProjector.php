<?php


namespace App\Projectors;


use App\Events\OrderCreated;
use App\Order;
use App\Repositories\OrderRepository;
use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;

class OrderProjector extends Projector
{
    public function __construct(public Repository $orderRepository) { }

    protected function applyOrderWasCreatedEvent(OrderCreated $orderCreated): void
    {
        $order = Order::create(
            $orderCreated->id,
            $orderCreated->productId,
            $orderCreated->colorId,
            $orderCreated->deliveryId
        );

        $this->orderRepository->save($order);
    }
}
