<?php


namespace App\Repositories;


use App\Models\Order;
use Broadway\ReadModel\ElasticSearch\ElasticSearchRepository;
use Broadway\ReadModel\Identifiable;
use Broadway\ReadModel\Repository;

class OrderReadRepository implements Repository
{
    private $repository;

    public function __construct(ElasticSearchRepository $repositoryFactory)
    {
        $this->repository = $repositoryFactory->create('order_repository', Order::class);
    }

    public function save(Order|Identifiable $data): void
    {
        $this->repository->save($data);
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
       return $this->repository->findAll();
    }

    public function remove($id): void
    {
        // TODO: Implement remove() method.
    }
}
