<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductAPITest extends TestCase
{
    /** @test */
    public function productCreate()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('api/product', ['product_id' => '123']);
        $response->assertStatus(200);
    }
}
