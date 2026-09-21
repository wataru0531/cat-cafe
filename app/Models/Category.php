<?php

// Models/Category.php
// ✅ カテゴリーのモデル。
// → blogsモデルに対して、親モデルとなる

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model {
  // ブログに対して、1対他 ということ
  // → 1つのCategoryは、複数のBlogを持つ
  public function blogs() {
    return $this->hasMany(Blog::class);
  }
}
