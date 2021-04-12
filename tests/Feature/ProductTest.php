<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        factory(Product::class, 5)->create();

        $response = $this->json('GET', route('product.index'));

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);
    }

    public function test_store()
    {

        $data = [
            'title' => 'title',
            'slug' => 'titt',
            'price' => 21,
            'description' => 'description'
        ];

        $response = $this->json('POST', route('product.store'), $data);

        $product = Product::first();
        $this->assertEquals($data['title'], $product->title);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);

    }
}
