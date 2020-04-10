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

    /** @test */
    public function a_product_inventory_number_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create();

        $this->assertCount(1, Product::all());

        $this->patch('/api/product/' . $product->id, ['quantity' => '333'] );

        $product = Product::first();

        $this->assertEquals('333', $product->quantity);
    }

    /** @test */
    public function a_product_price_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create();

        $this->assertCount(1, Product::all());

        $this->patch('/api/product/' . $product->id, ['price' => '22'] );

        $product = Product::first();

        $this->assertEquals('22', $product->price);
    }

    /** @test */
    public function a_product_can_be_deactived()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create(['active' => true]);

        $this->assertCount(1, Product::all());

        $this->patch('/api/product/' . $product->id, ['active' => false]);

        $product = Product::first();

        $this->assertEquals(0, $product->active);

    }

    /** @test */
    public function a_product_can_be_activated()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create(['active' => false]);

        $this->assertCount(1, Product::all());

        $this->patch('/api/product/' . $product->id, ['active' => true]);

        $product = Product::first();

        $this->assertEquals(1, $product->active);

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
