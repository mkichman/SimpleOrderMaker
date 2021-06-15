<?php


namespace App\Handlers;


use App\Commands\SelectDeliveryCommand;
use App\Delivery;
use Broadway\CommandHandling\SimpleCommandHandler;
use Broadway\EventSourcing\EventSourcingRepository;

class SelectDeliveryHandler extends SimpleCommandHandler
{
    public function __construct(public EventSourcingRepository $repository) { }

    public function handleSelectDeliveryCommand (SelectDeliveryCommand $selectDeliveryCommand) :void
    {
        $delivery = Delivery::create(
            $selectDeliveryCommand->deliveryId
        );
        $this->repository->save($delivery);
    }
}
