<?php


namespace App\Src\Application\Handler;

use App\Src\Application\Command\CreateOrderCommand;
use App\Src\Domain\Order as OrderModel;
use App\Src\Domain\OrderRepositoryInterface;
use Broadway\CommandHandling\SimpleCommandHandler;

class CreateOrderHandler extends SimpleCommandHandler
{
    public function __construct(public OrderRepositoryInterface $orderRepository) { }

    public function handleCreateOrderCommand(CreateOrderCommand $createOrderCommand) :void
    {
        $order = new OrderModel(123, $createOrderCommand->productId,   $createOrderCommand->deliveryId);

       $this->orderRepository->save($order);
    }
}
