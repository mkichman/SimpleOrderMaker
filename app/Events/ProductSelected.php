<?php


namespace App\Events;

use Broadway\Serializer\Serializable;

final class ProductSelected implements Serializable
{
    public function __construct(public int $id) { }

    public static function deserialize(array $data): ProductSelected
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
