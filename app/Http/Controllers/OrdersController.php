<?php


namespace App\Http\Controllers;

use App\Src\Application\Command\CreateOrderCommand;
use App\Src\Application\Query\OrderListQuery;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * OrdersController constructor.
     */
    public function __construct(private Dispatcher $commandBus, private OrderListQuery $orderListQuery)
    {
    }

    public function placeOrder(Request $request)
    {
       $this->commandBus->dispatch(new CreateOrderCommand($request->orderedProduct, $request->delivery));

        return redirect('/finish');
    }

    public function list(): array
    {
        return $this->orderListQuery->list();
    }
}
