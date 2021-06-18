<?php


namespace App\Repositories;

use App\Domain\Interfaces\OrderDomainInterface;
use App\Eloquent\Transformers\OrderTransformer;
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

    public function save(AggregateRoot|OrderDomainInterface $aggregate): void
    {
        parent::save($aggregate);

        $orderTransformer = new OrderTransformer();
        $entity = $orderTransformer->domainToEntity($aggregate);
        $entity->save();
    }
}
