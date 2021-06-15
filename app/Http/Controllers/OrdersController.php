<?php


namespace App\Http\Controllers;

use App\Commands\SelectProductCommand;
use App\Handlers\SelectProductHandler;
use App\Projectors\ProductProjector;
use App\Repositories\ProductRepository;
use Broadway\CommandHandling\SimpleCommandBus;
use Broadway\EventHandling\SimpleEventBus;
use Broadway\EventStore\InMemoryEventStore;
use Broadway\ReadModel\InMemory\InMemoryRepository;
use Illuminate\Http\Request;


class OrdersController extends Controller
{
    public function listProduct(SimpleEventBus $eventBus, InMemoryRepository $repository)
    {
        $productProjector = new ProductProjector($repository);
        $eventBus->subscribe($productProjector);

        $productProjector->printProduct();
    }

    public function addProduct(SimpleCommandBus $commandBus, Request $request, SimpleEventBus $eventBus)
    {
        $inMemoryRepository = new InMemoryRepository();
        $productProjector = new ProductProjector($inMemoryRepository);
        $command = new SelectProductCommand($request->orderedProduct);

        $eventBus->subscribe($productProjector);
        $commandHandler = new SelectProductHandler(new ProductRepository(new InMemoryEventStore(), $eventBus, []));
        $commandBus->subscribe($commandHandler);

        $commandBus->dispatch($command);
        $this->listProduct($eventBus, $inMemoryRepository);
    }
}
