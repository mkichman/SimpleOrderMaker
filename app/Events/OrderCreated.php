<?php


namespace App\Events;


use Broadway\Serializer\Serializable;

final class OrderCreated implements Serializable
{
    public function __construct(public int $productId, public int $deliveryId) { }

    public static function deserialize(array $data): OrderCreated
    {
        return new self(
            $data['productId'],
            $data['deliveryId']
        );
    }

    public function serialize(): array
    {
        return [
            'productId'     => $this->productId,
            'deliveryId'    => $this->deliveryId
        ];
    }
}
