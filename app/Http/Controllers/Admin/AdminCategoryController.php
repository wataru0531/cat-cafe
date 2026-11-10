<?php

// ✅ カテゴリーに関するコントローラ

// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// 確認

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller {
  // 一覧ページ
  public function index() {
    // $categories = Category::all();

    // withCount("blogs") → 内部で各カテゴリに紐づいているブログの件数を数えている。
    // 　　　　　　　　　　　　また、カテゴリー数を取得して返す。
    //                     取得したカテゴリには blogs_count という属性が追加される
    $categories = Category::withCount("blogs")
                    ->latest()
                    ->get();
    // dd($categories);

    // compact() は、変数を配列に変換するPHPの関数
    // compact("categories")で、["categories" => $categories]が作られる
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
  public function store(StoreCategoryRequest $request) {
    $validated = $request->validated();

    Category::create($validated);

    return to_route("admin.categories.index")->with("success", "カテゴリーを作成しました。");
  }

  // ❌ 詳細画面
  public function show(string $id) {}

  // 編集
  public function edit(string $categoryId) {
    $category = Category::findOrFail($categoryId);

    return view("admin.categories.edit", [
      "category" => $category,
    ]);
  }

  // 更新
  // TODO 更新用のリクエストオブジェクトを作ってもいい。
  public function update(UpdateCategoryRequest $request, string $categoryId) {
    $category= Category::findOrFail($categoryId);

    $validated = $request->validated();

    $category->update($validated); // DBを上書き保存

    return to_route("admin.categories.index")->with("success", "カテゴリーを更新しました。");
  }

  // ✅ 削除
  public function destroy(string $categoryId) {
    $category = Category::findOrFail($categoryId);

    // カテゴリーに紐づいているブログがまだ存在している場合は削除できない
    if($category->blogs()->exists()) {
      return to_route("admin.categories.index")
              ->with("error", "ブログに使用されているカテゴリは削除できません。");
    }

    $category->delete();
    return to_route("admin.categories.index")->with("success", "カテゴリーを削除しました。");
  }
}
