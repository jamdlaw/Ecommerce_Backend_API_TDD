<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderProducts;

class Order extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(orderProducts::class);
    }
}
