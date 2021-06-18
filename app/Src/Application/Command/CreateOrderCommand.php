<?php


namespace App\Src\Application\Command;


final class CreateOrderCommand
{
    public function __construct(public int $productId, public int $deliveryId) {}
}
