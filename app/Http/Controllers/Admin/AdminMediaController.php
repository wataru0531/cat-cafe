<?php

// ✅ Mediaのコントローラ

// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// Mediasの流れから確認。

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use App\Http\Requests\Admin\UpdateMediaRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Throwable;

// ✅ ファイルライブラリページ
// admin/media/index.blade.php ... 一覧
// admin/media/create ... 作成
// post admin/media ... upload
// admin/media/{mediaId} ... ファイル詳細
// delete admin/media/{media} ... 削除

class AdminMediaController extends Controller {

  // 一覧
  public function index() {
    // with("uploader") ... ユーザー情報も取得する
    $medias = Media::with("uploader")->latest()->paginate(20);

    return view("admin.medias.index", [
      "medias" => $medias,
    ]);
  }

  // 作成画面
  public function create(){
    return view("admin.medias.create");
  }

  // 作成(ファイル、DBに保存)の処理
  // TODO Requestオブジェクトを作成
  public function store(StoreMediaRequest $request) {
    $validated = $request->validated();

    $image = $request->file("image");
    $path = $image->store("medias", "public"); // フォルダに保存。保存先のパス    

    $imageInfo = getimagesize($image->getRealPath()); // 画像の詳細データを取得
    $width = $imageInfo[0] ?? null;
    $height = $imageInfo[1] ?? null;
    
    try {
      $validated["original_name"] = $image->getClientOriginalName();
      $validated["disk"] = "public";
      $validated["path"] = $path;
      $validated["mime_type"] = $image->getMimeType(); // 拡張子のタイプ
      $validated["size"] = $image->getSize();
      $validated["width"] = $width;
      $validated["height"] = $height;
      $validated["uploaded_by"] = Auth::user()->id;

      Media::create($validated); // DBに保存

      } catch(Throwable $e) {
      // DB登録に失敗した場合は画像も削除
      // disk() ... ここでは、storage/publicフォルダに保存されているファイルを指定する。
      Storage::disk('public')->delete($path);
      throw $e;
    }

    return to_route("admin.medias.index")->with("success", "画像をアップロードしました。");
  }

  // ✅ 編集画面
  public function edit(string $mediaId) {
    $media = Media::findOrFail($mediaId);

    return view("admin.medias.edit", [
      "$media" => $media,
    ]);
  }

  // ✅ 編集処理
  public function update(UpdateMediaRequest $request, string $mediaId) {
    $media = Media::findOrFail($mediaId);
    $updateData = $request->validated();
    $media->update($updateData);

    return to_route('admin.medias.index')->with("success", "画像名の更新を行いました。");
  }

  // ✅ 削除処理
  public function destroy(string $mediaId){
    $media = Media::findOrFail($mediaId);
    $media->delete(); // DBから削除

    Storage::disk("public")->delete($media->path);  // Storage領域から削除

    return to_route("admin.medias.index")->with("success", "画像を削除しました。");
  }

}
