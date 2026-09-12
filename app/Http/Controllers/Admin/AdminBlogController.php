<?php

// Http/Controllers/Admin/AdminBlogController.php

// 管理画面のブログ一覧画面、ブログ投稿画面を表示する処理を記述

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBlogController extends Controller {

  // ブログ一覧画面
  public function index() {
    return view("admin.blogs.index");
  }

  // ブログ投稿画面
  public function create() {
    return view("admin.blogs.create");
  }

  // 
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   */
  public function show(Blog $blog)
  {
      //
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
