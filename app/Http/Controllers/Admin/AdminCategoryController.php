<?php

// ✅ カテゴリーに関するコントローラ

// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// 確認

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller {
  
  // 一覧ページ
  public function index() {
    // $categories = Category::all();

    // withCount("blogs") → カテゴリごとに紐づいているブログの件数を取得
    //                     取得したカテゴリには blogs_count という属性が追加される
    $categories = Category::withCount("blogs")
                    ->latest()
                    ->get();

    return view("admin.categories.index", compact("categories"));

    // return view("admin.categories.index", [
    //   "categories" => $categories,
    // ]);
  }

  // 作成画面表示
  public function create() {
    return view("admin.categories.create");
  }

  // カテゴリーをDBに入れる
  // Requestsフォルダに作ってもいい
  public function store(Request $request) {
    $validated = $request->validate( [
      "name" => ["required", "string", "max:255", "unique:categories,name"],
    ]);

    Category::create($validated);

    return to_route("admin.categories.index")->with("success", "カテゴリーを作成しました。");
  }

  // ❌ 詳細画面
  public function show(string $id) {}

  // 編集
  public function edit(string $categoryId) {
    $category = Category::findOfFail($categoryId);

    return view("admin.category.edit", [
      "category" => $category,
    ]);
  }

  // 更新
  // TODO 更新用のリクエストオブジェクトを作ってもいい。
  public function update(Request $request, string $categoryId) {
    $category= Category::findOrFail($categoryId);

    $validated = $request->validate([
      "name" => [
        "required",
        "string",
        "max:255",
        "unique:categories,name" . $category->id,
      ],
    ]);

    $category->update($validated); // DBを上書き保存

    return to_route("admin.categories.index")->with("success", "カテゴリーを更新しました。");
  }

  // ✅ 削除
  public function destroy(string $categoryId) {
    $category = Category::findOfFail($categoryId);

    // カテゴリーに紐づいているブログがまだ存在している場合は削除できない
    if($category->blogs()->exists()) {
      return to_route("admin.categories.index")
              ->with("success", "ブログに使用されているカテゴリは削除できません。");
    }

    $category->delete();
    to_route("admin.category.index")->with("success", "カテゴリーを削除しました。");
  }
}
