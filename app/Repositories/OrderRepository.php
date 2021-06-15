<?php


namespace App\Repositories;

use App\Order;
use Broadway\Domain\AggregateRoot;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\NamedConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;

class OrderRepository extends EventSourcingRepository
{
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    ) {
        parent::__construct($eventStore,
            $eventBus,
            Order::class,
            new NamedConstructorAggregateFactory(),
            $eventStreamDecorators);
    }

//    public function get(Order $order): ?Order
//    {
//        $order = $this->eventSourcingRepository->load($order->get());
//
//        return $order;
//    }

    public function save(AggregateRoot $order): void
    {
        $this->eventSourcingRepository->save($order);
    }
}
