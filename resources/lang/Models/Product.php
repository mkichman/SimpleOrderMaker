<?php


namespace App\Models;


use Broadway\ReadModel\SerializableReadModel;

final class Product implements SerializableReadModel
{
    public function __construct(public int $id) {}

    public function getId(): string
    {
        return $this->id;
    }

    public static function deserialize(array $data)
    {
        return new static($data['id']);
    }

    public function serialize(): array
    {
       return [
           'id' => $this->id
       ];
    }
}
