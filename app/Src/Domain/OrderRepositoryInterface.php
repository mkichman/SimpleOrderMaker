<?php

namespace App\Src\Domain;

interface OrderRepositoryInterface
{
    public function save(Order $orderModel): void;


    /**
     * @return Order[]
     */
    public function list(): array;
}
