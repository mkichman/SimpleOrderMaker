<?php


namespace App\Src\Domain;


final class Order
{
    public function __construct(public string $id, public int $productId, public int $deliveryId) {}

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getDeliveryId(): int
    {
        return $this->deliveryId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }
}
