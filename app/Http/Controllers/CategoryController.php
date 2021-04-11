<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Category::latest()->get();

            return response()->json([
                'category_list' => $categories,
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
    public function store(CategoryRequest $request)
    {

        DB::beginTransaction();
        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            DB::commit();

            $categories = Category::all();

            return response()->json([
                'category_list' => $categories,
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if($category) {
            return response()->json([
                'category' => $category,
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->save();
            DB::commit();

            return response()->json([
                'category' => $category,
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category) {
            $category->delete();
            return response()->json([
                'message' => '成功'
            ],200);
        } else {
            return response()->json([
                'message' => '失敗'
            ],500);
        }
    }
}
