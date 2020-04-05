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
        $customer = Customer::create(['name' => 'James Lawrence']);

        $this->assertCount(1, Customer::all() );
        
    }
}
