<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Category;
use App\Product;

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
        $this->assertEmpty($eloquent->get());
        $entity = factory(Category::class)->create();
        $this->assertNotEmpty($eloquent->get());
    }

    public function testCategoryHasManyProducts()
    {
        $count = 5;
        $categoryEloquent = app(Category::class);
        $productEloquent = app(Product::class);
        $category = factory(Category::class)->create(); // アーティストを作成
        $products = factory(Product::class, $count)->create([
            'category_id' => $category->id,
        ]); // アーティストに紐づくアルバムレコードを作成 （create の引数に指定するとその値でデータ作成される）
        // refresh() で再度同じレコードを取得しなおし、リレーション先の件数が作成した件数と一致することを確認し、リレーションが問題ないことを保証
        $this->assertEquals($count, count($category->refresh()->products));
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
