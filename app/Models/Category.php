<?php

// Models/Category.php
// ✅ カテゴリーのモデル。
// → blogsモデルに対して、親モデルとなる

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model {

  protected $fillable = [
    "name",
  ];

  // ブログに対して、1 対 多
  // → 1つのCategoryは、複数のBlogに紐づく
  public function blogs() {
    return $this->hasMany(Blog::class);
  }
}
