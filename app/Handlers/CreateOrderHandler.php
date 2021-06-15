<?php


namespace App\Handlers;

use App\Commands\CreateOrderCommand;
use App\Order;
use App\Repositories\OrderRepository;
use Broadway\CommandHandling\SimpleCommandHandler;

class CreateOrderHandler extends SimpleCommandHandler
{
    public function __construct(public OrderRepository $orderRepository) { }

    public function handleCreateOrderCommand(CreateOrderCommand $createOrderCommand) :void
    {
        $order = Order::create(
            $createOrderCommand->id,
            $createOrderCommand->productId,
            $createOrderCommand->deliveryId
        );
        $this->orderRepository->save($order);
    }
}
