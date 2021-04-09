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
    public function test_新しい投稿を作成して返却する()
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

    public function test_正しい構造のjsonを返却する()
    {
        $response = $this->json('GET', route('category.index'));

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);
    }
}
