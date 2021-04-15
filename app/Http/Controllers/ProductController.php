<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::with('category')->latest()->get();

            return response()->json([
                'product_list' => $products,
                'message' => '成功'
            ],200);
        }
        catch(\Exception $e) {
            return response()->json([
                'message' => '取得できませんでした。'
            ],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create([
                'title' => $request->title,
                'slug' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);
            DB::commit();

            $products = Product::all();

            return response()->json([
                'product_list' => $products,
                'message' => '成功'
            ],200);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => '失敗'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product) {
            return response()->json([
                'product' => $product,
                'message' => '成功'
            ],200);
        } else {
            return response()->json([
                'message' => '失敗'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {

        DB::beginTransaction();
        try {
            $product->title = $request->title;
            $product->slug = $request->title;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();
            DB::commit();

            return response()->json([
                'product' => $product,
                'message' => '成功'
            ],200);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => '失敗'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
