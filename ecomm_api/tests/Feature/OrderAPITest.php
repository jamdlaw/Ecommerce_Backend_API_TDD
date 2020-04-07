<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Order;
use App\Customer;

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

    private function data()
    {
        return [
            'product_id' => 1, 
            'quantity' => 3,          
        ];
    }
}
