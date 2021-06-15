<?php


namespace App\Events;


final class DeliverySelected
{
    public function __construct(public int $id) { }
}
