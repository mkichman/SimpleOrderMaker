<?php


namespace App\Events;


use Broadway\Serializer\Serializable;

final class OrderCreated implements Serializable
{
    public string $id;

    public int $productId;
    public int $deliveryId;

    public function __construct(string $id, int $productId, int $deliveryId) { }

    public static function deserialize(array $data): OrderCreated
    {
        return new self(
            $data['id'],
            $data['productId'],
            $data['deliveryId']
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'productId'     => $this->productId,
            'deliveryId'    => $this->deliveryId
        ];
    }
}
