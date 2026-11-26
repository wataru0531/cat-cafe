<?php

// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// 詳細ページが表示されないので確認


// ✅ ブログ。一般ユーザー向け

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;


class BlogController extends Controller {
  // ✅ 一覧
  public function index() {
    // latest() ... 降順に並べる。
    // $blogs = Blog::latest()->get();
    $blogs = Blog::with(['category', 'user'])->latest()->simplePaginate('10');

    return view("blogs.index", [
      "blogs" => $blogs,
    ]);
  }

  // ✅ 詳細ページ
  public function show(string $blogId) {
    // dd($blogId);
    // 紐づいているカテゴリー、ユーザーのデータも取得する。
    $blog = Blog::with(["category", "user"])->findOrFail($blogId);

    return view("blogs.show", [
        "blog" => $blog,
    ]);
  }
}