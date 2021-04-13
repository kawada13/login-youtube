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
    public function testFactoryable()
    {
        $eloquent = app(Category::class);
        $this->assertEmpty($eloquent->get()); // 初期状態では空であることを確認
        $entity = factory(Category::class)->create(); // 先程作ったファクトリーでレコード生成
        $this->assertNotEmpty($eloquent->get()); // 再度getしたら中身が空ではないことを確認し、ファクトリ可能であることを保証
    }

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
    public function test_update()
    {

        factory(Category::class)->create();
        $category = Category::first();

        $params = [
            'name' => 'editName',
        ];

        $response = $this->json('PUT', route('category.update', [
            'category' => $category->id,
        ]), $params);

        $this->assertDatabaseHas('categories', $params);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);

    }

    public function test_index()
    {
        factory(Category::class, 5)->create();

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
                'message' => '成功'
            ]);
    }

    public function test_delete()
    {
        factory(Category::class)->create();
        $category = Category::first();

        $response = $this->json('DELETE', route('category.destroy', [
            'category' => $category->id,
        ]));

        $params = [
            'id' => $category->id
        ];

        $this->assertDatabaseMissing('categories', $params);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);
    }
}
