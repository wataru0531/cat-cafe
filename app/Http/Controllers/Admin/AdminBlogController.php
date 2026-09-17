<?php

// Http/Controllers/Admin/AdminBlogController.php

// ✅ 管理画面のブログ一覧画面、ブログ投稿画面を表示する処理を記述
//    管理者向けにブログ機能を担当させるController
//    管理者がアクセスしたときに表示させる画面

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class AdminBlogController extends Controller {

  // ✅ ブログ一覧画面
  public function index() {
    return view("admin.blogs.index");
  }

  // ✅ ブログ投稿画面
  public function create() {
    return view("admin.blogs.create");
  }


  // ✅ ブログ投稿処理
  // StoreBlogRequest → バリデーションを定義したクラス
  public function store(StoreBlogRequest $request) {
    // 画像保存
    // blogs → フォルダ名。/storage/public/blogs/ に保存
    $savedImagePath = $request->file("image")->store("blogs", "public"); 
    $blog = new Blog($request->validated()); // 入力データからblogモデルを作る
    $blog->image = $savedImagePath; // パスを設定
    $blog->save(); // DBに保存

    return to_route("admin.blogs.index")->with("success", "ブログを投稿しました。");
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
