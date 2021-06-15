<?php


namespace App;

use App\Events\ProductSelected;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Broadway\ReadModel\Identifiable;

class Product extends EventSourcedAggregateRoot implements Identifiable
{
    private string $id;

    public static function create(string $id): self
    {
        $product = new self();


        $product->apply(
            new ProductSelected($id));

        return $product;
    }


    public function getAggregateRootId(): string
    {

        return $this->id;
    }

    protected function applyProductSelected(ProductSelected $event): void
    {
        $this->id           = $event->id;
    }

    public function getId(): string
    {
        return $this->getAggregateRootId();
    }
}
