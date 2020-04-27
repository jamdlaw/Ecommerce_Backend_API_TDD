<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Order;
use App\Customer;
use App\OrderProducts;
use Symfony\Component\HttpFoundation\Response;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected $order, $user; 

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->order = factory(Order::class)->create();

    }

    /** @test */
    public function a_order_can_be_created()
    {
        
       // $this->withoutExceptionHandling();
        //order creation was handeled in setup function
        $this->assertCount(1, Order::all());
    
    }

    /** @test */
    public function products_can_be_added_to_order()
    {
        //$this->withoutExceptionHandling();
        $order = factory(Order::class)->create();
        
        $orderProduct = OrderProducts::create([
                                                'order_id' => $order->id,
                                                'product_id' => 2, 
                                                'quantity' => 3, 
                                                'price' => 10.00,
                                            ]);
        
        

        $order = Order::where('id', $order->id)->first();
        
        $this->assertEquals($order->products()->first()->order_id, $order->id);
        $this->assertEquals($order->products()->first()->product_id, 2);
        $this->assertEquals($order->products()->first()->quantity, 3);
    }

    /** @test */
    public function only_auth_api_user_can_pull_pending_orders()
    {
      //  $this->withoutExceptionHandling();
        $orderWeDoNotWant = factory(Order::class)->create(['status' => 'processing']);
        $anotherOrderWeDoNotWant = factory(Order::class)->create(['status' => 'processing']);

        $response = $this->get('/api/orders/?api_token=' . $this->user->api_token);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([ //+response
                               'data' => [ // + collection
                                   [ // + object in collection
                                       'data' => ['order_id'=> $this->order->id ] // data in the object
                                       ] // - object in collection
                               ] // - collection
        ]); // - response
    }


    /** @test */
    public function a_order_status_can_be_updated_to_processing()
    {
        //  $this->withoutExceptionHandling();
        $order = factory(Order::class)->create(['status' => 'pending']);

        $reponse = $this->patch('/api/order/' . $order->id .'?api_token=' . $this->user->api_token  , ['status' => 'processing']);

        $order = Order::find($order->id);

        $this->assertEquals('processing', $order->status );
    }

    /** @test */
    public function bad_shipment_records_will_not_be_saved()
    {
        
        collect(['order_id', 'tracking_code'])
        ->each(function ($field){
            $response = $this->post('/api/order/shipments/' . $this->order->id, array_merge($this->shipmentData(), [$field=>'']));
            $response->assertSessionHasErrors($field);
        });
    }

    /** @test */
    /* this test needs some work it is throwing a model not found exception and
    // I don't know how to handel it gracefully 
    public function shipment_record_must_be_attached_to_an_order()
    {
        $bad_order_id = 100000;
        $response =  $this->post('/api/order/shipments/' . $bad_order_id,  
                                            array_merge($this->shipmentData(), 
                                                        ['order_id' => $bad_order_id]
                                                    ));
        
        $response->assertSessionHasErrors();
    }
    */

    /** @test */
    public function a_order_can_have_shipment_records_saved()
    {
      //  $this->withoutExceptionHandling();
        $this->post('/api/order/shipments/' . $this->order->id,  $this->shipmentData());
        
        $order = Order::find($this->order->id);
        $this->assertEquals($order->shipments()->first()->tracking_code, '12lk4kaDkfo45');
    }

    private function data()
    {
        return [
            'customer_id' => factory(Customer::class),  
            'status' => "pending",
        ];
    }

    private function shipmentData()
    {
        return [
            'order_id' => $this->order->id,
            'carrier' => 'fedex',
            'shipping_level' => 'ground',
            'tracking_code' => '12lk4kaDkfo45',
            'api_token' => $this->user->api_token,
        ];
    }
}
