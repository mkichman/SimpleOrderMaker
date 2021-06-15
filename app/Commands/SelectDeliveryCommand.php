<?php


namespace App\Commands;


final class SelectDeliveryCommand
{
    public function __construct(public int $deliveryId) {}
}
