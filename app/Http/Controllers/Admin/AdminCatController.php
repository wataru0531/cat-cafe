<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCatRequest;
use App\Http\Requests\Admin\UpdateCatRequest;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCatController extends Controller {
  // ✅ 一覧表示
  public function index() {
    $cats = Cat::latest()->paginate(10);

    return view("admin.cats.index", compact("cats"));
  }

  // ✅ 作成
  public function create() {
    $cats = Cat::all();
    
    return view("admin.cats.create", [
      "cats" =>  $cats,
    ]);
  }

  // ✅ 保存
  public function store(StoreCatRequest $request) {
    $validated = $request->validated();

    $validated["image"] = $request->file("image")->store("cats", "public");

    Cat::create($validated); // DBに保存
  
    return to_route("admin.cats.index")->with("success", "ねこを登録しました。");
  }

  // ✅ 更新
  public function edit(string $catId) {
    $cat = Cat::findOrFail($catId);

    return view("admin.cats.edit", [
      "cat" => $cat,
    ]);
  }

  public function update(UpdateCatRequest $request, string $catId) {
    $cat = Cat::findOrFail($catId);

    $updateData = $request->validated();

    if($request->has("image")) {
      Storage::disk("public")->delete($cat->image); // 変更前の画像を削除
      $updateData["image"] = $request->file("image")->store("cats", "public");
    }

    $cat->update($updateData); // DBを更新

    return to_route("admin.cats.index")->with("success", "ねこを更新しました。");
  }

  public function destroy(string $catId) {
    $cat = Cat::findOrFail($catId);

    if($cat->blogs()->exists()) {
      return to_route("admin.cats.index")->with("error", "この猫はブログに登録されているため削除できません。");
    }

    $cat->delete();
    Storage::disk("public")->delete($cat->image);

    return to_route("admin.cats.index")->with("success", "猫を削除しました。");
  }

}
