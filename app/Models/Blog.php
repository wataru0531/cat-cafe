<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// $fillable
// → 配列の値をモデルの属性にまとめて代入することを一括代入と言い、
//   @fillableは、一括代入してもよいカラムを明示する設定のこと
//   new Blog($request->validated()); この部分。
// ※ もしモデルがすべての項目を無条件に受け入れると、ユーザーが
//   本来変更できないはずの項目まで変更できてしまう危険がありために設定する

class Blog extends Model {
  // 一括代入を許可。
  // ※ imageは $blog->image = $savedImageとして個別に代入しているので一括代入の対象がい
  protected $fillable = [
    "title",
    "image",
    "body"
  ];

  // ⭐️ カテゴリーが親だということ
  //    1つのBlogは、1つのCategoryに属する
  public function category() {
    // belongsTo()とすることで、blogsのcategory_id と categoriesの idとが紐付けられる
    // → Laravelが推測して関連づけが行われる。
    return $this->belongsTo(Category::class);
  }

  // ✅ リレーション。多対多
  // ブログ登録画面の、登録するねこの部分で使う
  // withTimestamps → 中間テーブルに追加した内容のcreated_at、updated_atも入力できる
  public function cats() {
    return $this->belongsToMany(Cat::class)->withTimestamps();
  }
}
