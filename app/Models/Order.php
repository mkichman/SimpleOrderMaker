<?php


namespace App\Models;


use Broadway\ReadModel\SerializableReadModel;

final class Order implements SerializableReadModel
{
    public function __construct(public string $id, public int $productId, public int $deliveryId) {}

    public function getId(): string
    {
        return $this->id;
    }

    public static function deserialize(array $data)
    {
        return new static(
            $data['id'],
            $data['productId'],
            $data['deliveryId']
        );
    }

    public function serialize(): array
    {
        return [
            'id'            => $this->id,
            'productId'     => $this->productId,
            'deliveryId'    => $this->deliveryId
        ];
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
