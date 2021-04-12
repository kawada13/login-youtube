<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use App\Category;

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

        factory(Category::class)->create();
        $category = Category::first();

        $params = [
            'title' => 'title',
            'slug' => 'titt',
            'price' => 21,
            'description' => 'description',
            'category_id' => $category->id,
        ];

        $response = $this->json('POST', route('product.store'), $params);
        
        $product = Product::first();
        $this->assertEquals($params['title'], $product->title);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);

    }
}
