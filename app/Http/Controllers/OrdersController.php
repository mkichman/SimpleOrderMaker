<?php


namespace App\Http\Controllers;

use App\Commands\SelectDeliveryCommand;
use App\Commands\SelectProductCommand;
use App\Handlers\SelectDeliveryHandler;
use App\Handlers\SelectProductHandler;
use App\Projectors\DeliveryProjector;
use App\Projectors\OrderProjector;
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
    public InMemoryRepository $inMemoryRepository;
    public SimpleCommandBus $commandBus;
    public SimpleEventBus $eventBus;
    public InMemoryEventStore $eventStore;

    public function __construct(SimpleCommandBus $commandBus, SimpleEventBus $eventBus)
    {
        $this->inMemoryRepository   = new InMemoryRepository();
        $this->commandBus           = $commandBus;
        $this->eventBus             = $eventBus;
        $this->eventStore           = new InMemoryEventStore();
    }

    public function listOrderItems()
    {
        $orderProjector = new OrderProjector($this->inMemoryRepository);
        $orderProjector->printOrderItems();
    }

    public function placeOrder(Request $request)
    {
        if(empty($request))
        {
            return;
        }
        $this->registerProductEvent($request->orderedProduct);
        $this->registerDeliveryEvent($request->delivery);

        $this->listOrderItems();
    }

    public function registerProductEvent($orderedProduct)
    {
        $productProjector = new ProductProjector($this->inMemoryRepository);
        $productCommand = new SelectProductCommand($orderedProduct);

        $this->eventBus->subscribe($productProjector);
        $productCommandHandler = new SelectProductHandler(new ProductRepository($this->eventStore,   $this->eventBus));

        $this->commandBus->subscribe($productCommandHandler);
        $this->commandBus->dispatch($productCommand);
    }

    public function registerDeliveryEvent($orderedDelivery)
    {
        $deliveryProjector = new DeliveryProjector($this->inMemoryRepository);
        $this->eventBus->subscribe($deliveryProjector);

        $deliveryCommand = new SelectDeliveryCommand($orderedDelivery);
        $deliveryCommandHandler = new SelectDeliveryHandler(new DeliveryRepository($this->eventStore, $this->eventBus));

        $this->commandBus->subscribe($deliveryCommandHandler);
        $this->commandBus->dispatch($deliveryCommand);
    }
}
