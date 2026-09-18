<?php

// Http/Controllers/Admin/AdminBlogController.php

// ✅ 管理画面のブログ一覧画面、ブログ投稿画面を表示する処理を記述
//    管理者向けにブログ機能を担当させるController
//    管理者がアクセスしたときに表示させる画面

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller {

  // ✅ ブログ一覧画面
  public function index() {
    $blogs = blog::all();

    return view("admin.blogs.index", [ // Viewで変数が使えるようにする
      "blogs" => $blogs,
    ]);
  }

  // ✅ ブログ投稿画面
  public function create() {
    return view("admin.blogs.create");
  }


  // ✅ ブログ投稿処理
  // StoreBlogRequest → バリデーションを定義したクラス
  public function store(StoreBlogRequest $request) {
    // 画像を保存
    // blogs → フォルダ名。/storage/app/public/blogs/ に保存
    $savedImagePath = $request->file("image")->store("blogs", "public"); 
    
    // ブログモデルを作る
    // $request->validated() ... バリデーション済みの入力データを取得
    $blog = new Blog($request->validated()); // 入力データからblogモデルを作る
    $blog->image = $savedImagePath; // パスを渡す。imageの内容を上書き
    $blog->save(); // DBに保存

    return to_route("admin.blogs.index")->with("success", "ブログを投稿しました。");
  }

  public function show(Blog $blog) {
      //
  }

  // ✅ 編集処理
  public function edit(string $id) {
    // 指定したIDのブログを編集
    // $blog = Blog::find($id); // なければnullを返す
    $blog = Blog::findOrFail($id); // なければ404を返す

    return View("admin.blogs.edit", [
      "blog" => $blog // $blogをViewで使えるようにする
    ]);
  }

  // ✅ データの更新
  public function update(UpdateBlogRequest $request, string $id) {
    $blog = Blog::findOrFail($id);

    $updateData = $request->validated(); // バリデーションを通過させたデータを取得

    if($request->has("image")) { // 画像が選択されている場合
      // dd($blog->image);
      // 変更前の画像を削除
      Storage::disk("public")->delete($blog->image);

      // storage/app/public/blogs/ のLaravelプロジェクト内に保存
      // パスが返される
      $updateData["image"] = $request->file("image")->store("blogs", "public");
    }

    $blog->update($updateData); // DBを更新
                                // → 一括更新なので、$fillableにimageを追加

    return to_route("admin.blogs.index")->with("success", "ブログを更新しました。");
  }

  // 
  public function destroy(Blog $blog) {
      //
  }
}
