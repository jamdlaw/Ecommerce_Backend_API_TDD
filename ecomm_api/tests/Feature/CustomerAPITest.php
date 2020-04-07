<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Customer;

class CustomerAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_customer_data()
    {
        $this->withoutExceptionHandling();
        
        $customer = factory(Customer::class)->create();
        $this->assertCount(1, Customer::all());
        
        $response = $this->get('api/customer/' . $customer->id );

        $response->assertJson(['firstName'=> $customer->firstName]);
    }

    private function data()
    {
        return [
            'firstName' => "James",
            'lastName' => ' Lawrence',
            'phone' => '555-5555',
            'email' => 'test@monkey.com',
            'address1' => '888 south st',
            'address2' => 'unit 88',
            'city' => 'San Diego',
            'state' => 'CA',
            'zip' => '92021',
        ];
    }
}
