<?php


namespace App\Http\Controllers;

use App\Domain\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function placeOrder(Request $request)
    {
        $orderDomain = new Order($request->orderedProduct, $request->delivery);
        $orderDomain->initEvents();
        $orderDomain->order();
        return redirect('/finish');
    }

    public function list(): array
    {
        return Order::list();
    }
}
