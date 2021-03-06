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
    public function testFactoryable()
    {
        $eloquent = app(Product::class);
        $this->assertEmpty($eloquent->get()); // 初期状態では空であることを確認
        $entity = factory(Product::class)->create(); // 先程作ったファクトリーでレコード生成
        $this->assertNotEmpty($eloquent->get()); // 再度getしたら中身が空ではないことを確認し、ファクトリ可能であることを保証
    }
    public function testProductBelongsToCategory()
    {
        $categoryEloquent = app(Category::class);
        $productEloquent = app(Product::class);
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create([
            'category_id' => $category->id,
        ]);
        $this->assertNotEmpty($product->category);
    }

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

    public function test_edit()
    {
        factory(Category::class)->create();
        $category = Category::first();

        $product = factory(Product::class)->create([
            'category_id' => $category->id,
        ]);

        $response = $this->json('GET', route('product.edit', [
            'product' => $product->id,
        ]));

        $response->assertStatus(200)
            ->assertJsonFragment([ //レスポンスjsonに以下の内容を含む
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'price' => $product->price,
                'description' => $product->description,
                'category_id' => $product->category_id,
                'message' => '成功'
            ]);
    }

    public function test_update()
    {

        factory(Category::class)->create();
        $category = Category::first();

        $product = factory(Product::class)->create([
            'category_id' => $category->id,
        ]);

        $params = [
            'title' => 'editTitle',
            'price' => 32,
            'description' => 'editDescription',
            'category_id' => $category->id,
        ];

        $response = $this->json('PUT', route('product.update', [
            'product' => $product->id,
        ]), $params);


        $this->assertDatabaseHas('products', $params);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);

    }

    public function test_delete()
    {
        factory(Category::class)->create();
        $category = Category::first();

        $product = factory(Product::class)->create([
            'category_id' => $category->id,
        ]);

        $response = $this->json('DELETE', route('product.destroy', [
            'product' => $product->id,
        ]));

        $params = [
            'id' => $product->id
        ];

        $this->assertDatabaseMissing('products', $params);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => '成功']);
    }
}