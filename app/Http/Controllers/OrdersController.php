<?php


namespace App\Http\Controllers;

use App\Commands\SelectDeliveryCommand;
use App\Commands\SelectProductCommand;
use App\Handlers\SelectDeliveryHandler;
use App\Handlers\SelectProductHandler;
use App\Projectors\DeliveryProjector;
use App\Projectors\ProductProjector;
use App\Repositories\DeliveryRepository;
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
        $productCommand = new SelectProductCommand($request->orderedProduct);

        $eventStore = new InMemoryEventStore();

        $eventBus->subscribe($productProjector);
        $productCommandHandler = new SelectProductHandler(new ProductRepository($eventStore, $eventBus));
        $commandBus->subscribe($productCommandHandler);

        $commandBus->dispatch($productCommand);
        $deliveryProjector = new DeliveryProjector($inMemoryRepository);
        $eventBus->subscribe($deliveryProjector);

        $deliveryCommand = new SelectDeliveryCommand($request->delivery);
        $deliveryCommandHandler = new SelectDeliveryHandler(new DeliveryRepository($eventStore, $eventBus));

        $commandBus->subscribe($deliveryCommandHandler);
        $commandBus->dispatch($deliveryCommand);
        $this->listProduct($eventBus, $inMemoryRepository);
    }
}
