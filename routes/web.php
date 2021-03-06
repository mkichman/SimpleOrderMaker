<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/placeOrder', function () {
    $products = json_decode(file_get_contents(base_path('resources/json/products.json')));
    $delivery = json_decode(file_get_contents(base_path('resources/json/delivery.json')));
    return view('order')->with([
        'products' => $products,
        'delivery' => $delivery
    ]);
});

Route::post('/placeOrder', [OrdersController::class, 'placeOrder']);

Route::get('/finish', function () {
    return redirect('/')->with('success', 'Order placed successfully');
});

Route::get('/allOrders', [OrdersController::class, 'list']);
