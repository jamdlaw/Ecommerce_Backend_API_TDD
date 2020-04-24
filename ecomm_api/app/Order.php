<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderProducts;
use App\OrderShipments;

class Order extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(orderProducts::class);
    }

    public function shipments()
    {
        return $this->hasMany(OrderShipments::class);
    }
}
