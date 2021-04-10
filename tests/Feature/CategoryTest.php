<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {

        $data = [
            'name' => 'namae',
            'slug' => 'aaa'
        ];

        $response = $this->json('POST', route('category.store'), $data);

        $category = Category::first();
        $this->assertEquals($data['name'], $category->name);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);

    }

    public function test_index()
    {
        $response = $this->json('GET', route('category.index'));

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);
    }

    public function test_edit()
    {
        factory(Category::class)->create();
        $category = Category::first();

        $response = $this->json('GET', route('category.edit', [
            'category' => $category->id,
        ]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ]);
    }
}
