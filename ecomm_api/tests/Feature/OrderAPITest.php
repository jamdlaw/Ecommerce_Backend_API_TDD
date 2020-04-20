<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Order;
use App\Customer;
use App\OrderProducts;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_order_can_be_created()
    {
        
        $this->withoutExceptionHandling();
        
        $customer = factory(Customer::class)->create();
        $order = Order::create(array_merge($this->data(), ['customer_id'=> $customer->id]));
        $this->assertCount(1, Order::all());
    
    }

    /** @test */
    public function products_can_be_added_to_order()
    {
        
        $order = factory(Order::class)->create();
        
        $orderProduct = OrderProducts::create([
                                                'order_id' => $order->id,
                                                'product_id' => 2, 
                                                'quantity' => 3, 
                                                'price' => 10.00
                                            ]);
        
        $this->assertCount(1, OrderProducts::all()); 

        $order = Order::all();
        //dd($order->products());
    }

    private function data()
    {
        return [
            'product_id' => 1, 
            'quantity' => 3,          
        ];
    }
}
