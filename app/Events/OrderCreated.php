<?php


namespace App\Events;


use Broadway\Serializer\Serializable;

final class OrderCreated implements Serializable
{
    public string $id;

    public int $productId;
    public int $colorId;
    public int $deliveryId;

    public function __construct(string $id, int $productId, int $colorId, int $deliveryId) { }

    public static function deserialize(array $data): OrderCreated
    {
        return new self(
            $data['id'],
            $data['productId'],
            $data['colorId'],
            $data['deliveryId']
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'productId'     => $this->productId,
            'colorId'       => $this->colorId,
            'deliveryId'    => $this->deliveryId
        ];
    }
}
