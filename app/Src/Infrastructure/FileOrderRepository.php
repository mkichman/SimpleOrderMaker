<?php


namespace App\Src\Infrastructure;


use App\Src\Domain\Order;
use App\Src\Domain\OrderRepositoryInterface;

class FileOrderRepository implements OrderRepositoryInterface
{
    public function save(Order $orderModel): void
    {
        $existingOrders = $this->parseOrdersFile();

        $existingOrders[$orderModel->getId()] = $orderModel;
        file_put_contents(base_path('resources/json/orders.json'), serialize($existingOrders));
    }

    /**
     * @return Order[]
     */
    private function parseOrdersFile(): array
    {
        $existingOrders = [];
        if(!file_exists(base_path('resources/json/orders.json')))
        {
            return $existingOrders;
        }
        $content = file_get_contents(base_path('resources/json/orders.json'));

        if($content !== false)
        {
            $existingOrders = unserialize($content, ['allowed_class' => [Order::class]]);
        }

        return $existingOrders;
    }

    /**
     * @return Order[]
     */
    public function list(): array
    {
       return $this->parseOrdersFile();
    }
}
