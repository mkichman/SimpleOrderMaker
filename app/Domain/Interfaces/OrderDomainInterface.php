<?php


namespace App\Domain\Interfaces;


interface OrderDomainInterface
{
    public function getProductId();
    public function getDeliveryId();
    public function getId();
}
