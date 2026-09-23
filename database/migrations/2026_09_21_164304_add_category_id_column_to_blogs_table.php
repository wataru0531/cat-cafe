<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// blogsテーブルにcategories_id カラムを追加する
// 外部キー制約も設定

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('blogs', function (Blueprint $table) {
        // ① nullableを設定する方法
        // $table->foreignId("category_id")->nullable()->after("id")->constrained();
      
        // foreign() ... 外部キー。categoriesのidを入れるカラムをつくる
        // default() ... デフォルトのカテゴリーを設定する
        // constrained() → Laravelがここは自動でblogsテーブルのcategory_idとCategoriesのidと紐づける
        //                 → Laravelには対象の命名規則があり、そこから予測できる
        $table->foreignId("category_id")->default(4)->after("id")->constrained();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::table('blogs', function (Blueprint $table) {
      $table->dropConstrainedForeignId("category_id");
    });
  }
};
