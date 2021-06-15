<?php


namespace App\Events;


final class DeliverySelected
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name) { }
}
