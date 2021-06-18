<?php


namespace App\Eloquent\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'productId',
        'deliveryId',
    ];

    protected $table = 'orders';

}
