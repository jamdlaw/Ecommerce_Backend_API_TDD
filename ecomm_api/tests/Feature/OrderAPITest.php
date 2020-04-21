<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Order;
use App\Customer;
use App\OrderProducts;
use Symfony\Component\HttpFoundation\Response;

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
                                                'price' => 10.00,
                                            ]);
        
        $this->assertCount(1, OrderProducts::all()); 

        $order = Order::where('id', $order->id)->first();
        
        $this->assertEquals($order->products()->first()->id, $order->id);
        $this->assertEquals($order->products()->first()->product_id, 2);
        $this->assertEquals($order->products()->first()->quantity, 3);
    }

    /** @test */
    public function orders_can_be_pulled_be_pending_status_code()
    {
    
        $order = factory(Order::class)->create(['status' => 'pending']);
        $orderWeDoNotWant = factory(Order::class)->create(['status' => 'processing']);
        $anotherOrderWeDoNotWant = factory(Order::class)->create(['status' => 'processing']);

        $ordersToSend = Order::where('status', '=', 'pending' )->get();

        $this->assertCount(1, $ordersToSend);
    }

    /** @test */
    public function pending_orders_can_be_pulled_from_api()
    {
        $this->withoutExceptionHandling();
        $orderWeDoNotWant = factory(Order::class)->create(['status' => 'processing']);
        $order = factory(Order::class)->create(['status' => 'pending']);
        $anotherOrderWeDoNotWant = factory(Order::class)->create(['status' => 'processing']);

        $response = $this->get('/api/orders');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
                                ['id'=> $order->id ]
        ]);
    }
    private function data()
    {
        return [
            'customer_id' => factory(Customer::class),  
            'status' => "pending",
        ];
    }
}
