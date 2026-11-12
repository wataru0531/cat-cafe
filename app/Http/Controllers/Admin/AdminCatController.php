<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCatRequest;
use App\Models\Cat;
use Illuminate\Http\Request;

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
  public function edit() {

  }

  public function update() {

  }

  public function destroy() {

  }

}
