<?php


namespace App\Projectors;

use App\Events\ProductSelected;
use App\Product;
use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;

class ProductProjector extends Projector
{
    public function __construct(public Repository $productRepository) { }

    protected function applyProductSelected(ProductSelected $productCreated): void
    {
        $product = Product::create(
            $productCreated->id
        );

        $this->productRepository->save($product);
    }

    public function printProduct()
    {
        dd($this->productRepository);
    }

//    private function loadReadModel($id)
//    {
//        return $this->productRepository->find($id);
//    }
}
