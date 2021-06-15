<?php


namespace App\Repositories;

use App\Product;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\NamedConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;

class ProductRepository extends EventSourcingRepository
{
    private EventSourcingRepository $eventSourcingRepository;
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    ) {

        parent::__construct(
            $eventStore,
            $eventBus,
            Product::class,
            new NamedConstructorAggregateFactory(),
            $eventStreamDecorators);

    }

//    public function get(Order $order): ?Order
//    {
//        $order = $this->eventSourcingRepository->load($order->get());
//
//        return $order;
//    }

//    public function save(AggregateRoot $product): void
//    {
//        $this->eventSourcingRepository->save($product);
//
//        dd($this->eventSourcingRepository->find(123));
//    }
}
