<?php


namespace App\Handlers;

use App\Commands\SelectProductCommand;
use App\Product;
use Broadway\CommandHandling\SimpleCommandHandler;
use Broadway\EventSourcing\EventSourcingRepository;

class SelectProductHandler extends SimpleCommandHandler
{
    public function __construct(public EventSourcingRepository $productRepository) { }

    public function handleSelectProductCommand(SelectProductCommand $selectProductCommand) :void
    {
        $product = Product::create(
            $selectProductCommand->productId
        );
        $this->productRepository->save($product);
    }
}
