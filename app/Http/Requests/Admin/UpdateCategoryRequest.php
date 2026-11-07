<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

  public function rules(): array {
    return [
      "name" => [
        "required",
        "string",
        "max:255",
        Rule::unique("categories", "name")->ignore($this->route("categoryId")),
        // → 自分自身のカテゴリーは重複チェックから除外する
        // unique ... categoriesカラムに同じnameがないかどうか検証
        // $this->route("categoryId") ... ルートから{categoryId}を取得
        // Route::put("/admin/categories/{categoryId}", [AdminCategoryController::class, "update"])->name("admin.categories.update")->middleware("auth");
      ]
    ];
  }
}
