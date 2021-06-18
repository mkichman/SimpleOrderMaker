<?php


namespace App\Eloquent\Transformers;


use App\Domain\Interfaces\OrderDomainInterface;
use App\Eloquent\Models\Order;
use App\Domain\Order as Domain;

class OrderTransformer
{
    public function domainToEntity(OrderDomainInterface $domain): Order
    {
        $order              = new Order();
        $order->productId   = $domain->getProductId();
        $order->deliveryId  = $domain->getDeliveryId();

        return $order;
    }

    public function entityToDomainMany(Order $order): array
    {
        $orders = $order->get();

        if(empty($orders))
        {
            return [];
        }

        $domainObjects = [];
        foreach($orders as $entity)
        {
            $domainObjects[$entity->id] = $this->entityToDomain($entity);
        }
        return $domainObjects;
    }

    public function entityToDomain($entity): Domain
    {
        return new Domain($entity->productId, $entity->deliveryId);
    }
}
