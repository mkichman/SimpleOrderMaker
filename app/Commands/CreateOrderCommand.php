<?php


namespace App\Commands;


final class CreateOrderCommand
{
    public int $id;
    public int $productId;
    public int $deliveryId;
}
