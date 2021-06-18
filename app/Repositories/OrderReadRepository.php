<?php


namespace App\Repositories;

use App\Domain\Exception\OrderNotFoundException;
use App\Eloquent\Transformers\OrderTransformer;
use Broadway\ReadModel\Identifiable;
use Broadway\ReadModel\Repository;

class OrderReadRepository implements Repository
{
    public function __construct(private OrderTransformer $orderTransformer) { }

    public function getById($id): array
    {
        $order = \App\Eloquent\Models\Order::find($id);

        if(null === $order)
        {
            throw new OrderNotFoundException();
        }

        return $this->orderTransformer->entityToDomain($order);
    }

    public function find($id): ?Identifiable
    {
        // TODO: Implement find() method.
    }

    public function findBy(array $fields): array
    {
        // TODO: Implement findBy() method.
    }

    public function findAll(): array
    {
        $order = new \App\Eloquent\Models\Order();
        return $this->orderTransformer->entityToDomainMany($order);
    }

    public function remove($id): void
    {
        // TODO: Implement remove() method.
    }

    public function save(Identifiable $data): void
    {
        // TODO: Implement save() method.
    }
}
