<?php


// ✅ ブログ。一般ユーザー向け

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;


class BlogController extends Controller {
  // ✅ 一覧
  public function index() {
    $blogs = Blog::latest()->get();

    return view("blogs.index", [
      "blogs" => $blogs,
    ]);
  }

  // ✅ 詳細ページ
  public function show(string $blogId) {
    // dd($blogId);
    $blog = Blog::findOrFail($blogId);

    return view("blogs.show", [
        "blog" => $blog,
    ]);
  }
}
