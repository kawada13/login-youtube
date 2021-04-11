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
}
