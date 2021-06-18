<?php


namespace App\Commands;


final class CreateOrderCommand
{
    public function __construct(public int $productId, public int $deliveryId) {}
}
