<?php

// php artisan migrate

// php artisan rollback

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('blogs', function (Blueprint $table) {
      $table->id();
      $table->string("title"); // 最大255文字
      $table->string("image");
      $table->text("body"); // 日本語 → 最大 約21,845文字程度
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('blogs');
  }
};
