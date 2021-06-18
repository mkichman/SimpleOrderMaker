<?php


namespace App\Domain;

use App\Commands\CreateOrderCommand;
use App\Commands\SelectDeliveryCommand;
use App\Commands\SelectProductCommand;
use App\Domain\Exception\EmptyDeliveryException;
use App\Domain\Exception\EmptyProductException;
use App\Eloquent\Transformers\OrderTransformer;
use App\Handlers\CreateOrderHandler;
use App\Handlers\SelectDeliveryHandler;
use App\Handlers\SelectProductHandler;
use App\Projectors\DeliveryProjector;
use App\Projectors\OrderProjector;
use App\Projectors\ProductProjector;
use App\Repositories\DeliveryRepository;
use App\Repositories\OrderReadRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Broadway\CommandHandling\SimpleCommandBus;
use Broadway\EventHandling\SimpleEventBus;
use Broadway\EventStore\InMemoryEventStore;
use Broadway\ReadModel\InMemory\InMemoryRepository;

class Order
{
    public InMemoryRepository $inMemoryRepository;
    public SimpleCommandBus $commandBus;
    public SimpleEventBus $eventBus;
    public InMemoryEventStore $eventStore;

    public function __construct(public ?int $productId,
                                public ?int $deliveryId) {}

    public function initEvents(): void
    {
        $this->inMemoryRepository   = new InMemoryRepository();
        $this->commandBus           = new SimpleCommandBus();
        $this->eventBus             = new SimpleEventBus();
        $this->eventStore           = new InMemoryEventStore();
    }

    public function order(): void
    {
        if(empty($this->deliveryId))
        {
            throw new EmptyDeliveryException();
        }
        if(empty($this->productId))
        {
            throw new EmptyProductException();
        }

        $this->registerProductEvent();
        $this->registerDeliveryEvent();
        $this->registerOrderEvent();
    }

    public function registerProductEvent(): void
    {
        $productProjector = new ProductProjector($this->inMemoryRepository);
        $productCommand = new SelectProductCommand($this->productId);

        $this->eventBus->subscribe($productProjector);
        $productCommandHandler = new SelectProductHandler(
            new ProductRepository($this->eventStore,   $this->eventBus));

        $this->subscribeAndDispatch($productCommandHandler, $productCommand);
    }

    public function registerDeliveryEvent(): void
    {
        $deliveryProjector = new DeliveryProjector($this->inMemoryRepository);
        $this->eventBus->subscribe($deliveryProjector);

        $deliveryCommand = new SelectDeliveryCommand($this->deliveryId);
        $deliveryCommandHandler = new SelectDeliveryHandler(
            new DeliveryRepository($this->eventStore, $this->eventBus));

        $this->subscribeAndDispatch($deliveryCommandHandler, $deliveryCommand);
    }

    public function registerOrderEvent(): void
    {
        $orderProjector = new OrderProjector($this->inMemoryRepository);
        $this->eventBus->subscribe($orderProjector);

        $orderComannd = new CreateOrderCommand($this->productId, $this->deliveryId);
        $orderCommandHandler = new CreateOrderHandler(
            new OrderRepository($this->eventStore, $this->eventBus));

        $this->subscribeAndDispatch($orderCommandHandler, $orderComannd);
    }

    private function subscribeAndDispatch($commandHandler, $command): void
    {
        $this->commandBus->subscribe($commandHandler);
        $this->commandBus->dispatch($command);
    }

    public static function list(): array
    {
        $orderReadRepository = new OrderReadRepository(new OrderTransformer());
        return $orderReadRepository->findAll();
    }
}
