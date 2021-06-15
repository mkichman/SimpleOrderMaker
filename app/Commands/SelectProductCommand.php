<?php


namespace App\Commands;


final class SelectProductCommand
{
    public function __construct(public int $productId) { }

    public function getProductId(): int
    {
        return $this->productId;
    }
}
