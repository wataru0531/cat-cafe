<?php

// ✅ Mediaに関するデータ

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('media', function (Blueprint $table) {
        $table->id();
        $table->string("original_name");
        $table->string("disk")->default("public"); // 保存先のデスク
        $table->string("path")->unique(); // ストレージ内の保存パス。unique ... 同じパスが重複しないようにする
        $table->string("mime_type", 100);
        $table->unsignedBigInteger("size"); // 
        $table->unsignedBigInteger("width")->nullable(); // 取得できない可能性があるのでnull。
        $table->unsignedBigInteger("height")->nullable();
        // アップロードしたユーザー
        // nullOnDelete ... ユーザーが削除されても画像情報を残す
        $table->foreignId("uploaded_by")->nullable()->constrained("users")->nullOnDelete();
        $table->index("created_at"); // 登録日時による検索・並び替え
        $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
      Schema::dropIfExists('media');
  }
};
