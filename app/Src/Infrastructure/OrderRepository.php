<?php


namespace App\Src\Infrastructure;

use App\Src\Domain\Order;
use App\Src\Domain\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var Order[]
     */
    private static array $inMemory = [];

    public function save(Order $orderModel): void
    {
        self::$inMemory[$orderModel->getId()] = $orderModel;
    }


    public function list(): array
    {
        return self::$inMemory;
    }

}
