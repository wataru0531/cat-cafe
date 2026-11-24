<?php

// 一般ユーザー向けのブログ機能を担当させるController
// 一般ユーザーが、/blogs などにアクセスしたときように表示させる

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
      // カテゴリ、ブログ、
      // $blogs = Blog::all();
      $blogs = blog::latest("updated_at")->limit(6)->get();

      return view("home.index", [
        "blogs" => $blogs,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog) {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
