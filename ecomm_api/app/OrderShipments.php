<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class OrderShipments extends Model
{
    protected $guarded = [];

    public function getOrders()
    {
        return $this->hasOne(Order::class);
    }
}
