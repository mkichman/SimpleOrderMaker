<?php


namespace App\Projectors;

use App\Events\ProductSelected;
use App\Product;
use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;

class ProductProjector extends Projector
{
    public function __construct(public Repository $repository) { }

    protected function applyProductSelected(ProductSelected $productCreated): void
    {
        $product = Product::create(
            $productCreated->id
        );

        $this->repository->save($product);
    }

    public function printProduct()
    {
        dd($this->repository);
    }

//    private function loadReadModel($id)
//    {
//        return $this->productRepository->find($id);
//    }
}
