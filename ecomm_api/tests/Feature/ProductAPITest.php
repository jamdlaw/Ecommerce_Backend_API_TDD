<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class ProductAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function productCreate()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('api/product', ['sku' => '123']);
        $response->assertStatus(200);

        $this->assertCount(1, Product::all());
    }
}
