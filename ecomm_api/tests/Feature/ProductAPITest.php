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
    public function a_product_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('api/product', $this->productTestData());
    
        $this->assertCount(1, Product::all());

        $product = Product::all()->first();

        $this->assertEquals('123456' , $product->sku );
        $this->assertEquals('Control Product A' , $product->name );
        $this->assertEquals('10' , $product->price );
        $this->assertEquals('this is the description for a controlled test product' , $product->description );
        $this->assertEquals('http://image_site.looking' , $product->image );
        $this->assertEquals('true', $product->active);
        $this->assertEquals('100', $product->quantity);
        
        
    }

    private function productTestData()
    {
        return [
            'sku' => '123456',
            'name' => 'Control Product A',
            'price' => '10.00',
            'description' => 'this is the description for a controlled test product',
            'image' => 'http://image_site.looking',
            'active'   => 'true',
            'quantity' => '100',
        ];
    }
}
