<?php

namespace App\Http\Controllers\Admin;

// -r ... index, create, store などが生成される
// php aritisan make:controller Admin/UserController -r --model=User

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller {
  public function index() {
    $users = User::all();

    return view("admin.users.index", [
      "users" => $users,
    ]);
  }

  // ✅ ユーザー登録画面
  public function create() {
    return view("admin.users.create");
  }

  // ✅ ユーザー登録処理
  // StoreUserRequest → バリデーションの記述
  public function store(StoreUserRequest $request) {
    // dd($request);
    $validated = $request->validated(); // バリデーション後のデータ取得
    // storage/app/public/users に保存
    $validated["image"] = $request->file("image")->store("users", "public");
    $validated["password"] = Hash::make($validated["password"]);

    User::create($validated);

    return back()->with("success", "ユーザー登録しました。");
  }

  // 詳細ページ → ✅ TODO 作るかどうか検討
  public function show(User $user) {}

  // 編集ページ
  public function edit(string $userId) {
    $user = User::findOrFail($userId);

    return view("admin.users.edit", [
      "user" => $user
    ]);
  }

  // 更新
  public function update(UpdateUserRequest $request, string $userId) {
    $user = User::findOrFail($userId);
    $updateData = $request->validated(); // バリデーション適用

    // 画像の処理
    if($request->has("image")) {
      Storage::disk("public")->delete($user->image);

      // storage/app/public/users/ のLaravelプロジェクト内に保存
      // ⭐️ このとき、imageのurlの先頭に users/ がついてDBに保存される。
      $updateData['image'] = $request->file("image")->store("users", "public");
    }

    // パスワードの処理
    if(!empty($updateData['password'])) {
      $updateData['password'] = Hash::make($updateData['password']);
    } else {
      unset($updateData['password']); // なければパスワードは更新対象から外す
    }

    $user->update($updateData); // DBを上書き更新
    return to_route("admin.users.index")->with("success", "ユーザーのデータを更新しました。");
  }


  // 削除
  public function destroy(string $userId) {
    $user = User::findOrFail($userId);
    $user->delete(); // DBから削除
    Storage::disk("public")->delete($user->image); // 対象ユーザーの画像を削除

    return to_route("admin.users.index")->with("success", "ユーザーを削除しました。");
  }
}
