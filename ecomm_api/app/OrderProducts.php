<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Orders;

class OrderProducts extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
