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

Route::get('/products', function () {
    $products = json_decode(file_get_contents(base_path('resources/json/products.json')));
    return view('products')->with([
        'products' => $products
    ]);
});

Route::post('/products', [OrdersController::class, 'addProduct']);

Route::get('/colors', function () {
    $colors = json_decode(file_get_contents(base_path('resources/json/colors.json')));
    return view('colors')->with([
        'colors' => $colors
    ]);
});

Route::get('/delivery', function () {
    $delivery = json_decode(file_get_contents(base_path('resources/json/delivery.json')));
    return view('delivery')->with([
        'delivery' => $delivery
    ]);
});


Route::get('/finish', function () {
    return redirect('/')->with('success', 'Order placed successfully');
});

Route::get('/orders', [OrdersController::class, 'listProduct'])->name('orders');
