<?php


namespace App\Src\Application\Query;


use App\Src\Domain\Order;
use App\Src\Domain\OrderRepositoryInterface;

class OrderListQuery
{
    public function __construct(private OrderRepositoryInterface $orderRepository)
    {
    }

    /**
     * @return Order[]
     */
    public function list(): array
    {
        $result = [];

        foreach($this->orderRepository->list() as $order)
        {
            $result[$order->getId()] = [
                'productId' => $order->getProductId(),
                'deliveryId' => $order->getDeliveryId()
            ];
        }
        return $result;
    }
}
