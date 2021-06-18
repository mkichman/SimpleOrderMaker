<?php


namespace App\Events;


use Broadway\Serializer\Serializable;

final class DeliverySelected implements Serializable
{
    public function __construct(public int $id) { }

    public static function deserialize(array $data)
    {
        return new self(
            $data['id']
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id
        ];
    }
}
