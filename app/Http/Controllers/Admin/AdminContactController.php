<?php

// ✅ 管理者向けのお問い合わせのコントローラ
// ページネーション

// 対応済みかどうかチェックマーク
// → contactsテーブルに is_completed

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;


class AdminContactController extends Controller {
  // お問い合わせ一覧
  public function index() {
    // latest() ... 新しい順に並べる
    $contacts = Contact::latest()->get();

    // return view("admin.contacts.index", [
    //   "contacts" => $contacts,
    // ]);

    // compact() ... $contactsをviewに渡すための配列をつくる
    return view('admin.contacts.index', compact('contacts'));
  }

  // お問い合わせ詳細
  public function detail(Contact $contact) {
    return view('admin.contacts.detail', compact('contact'));
  }

  // 削除
  public function destroy(string $id) {
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return to_route("admin.contacts.index")->with("success", "問い合わせを削除しました。");
  }

  // ✅ 対応済みかどうかの確認(緑のチェックマーク)
  // → is_completedを反転させる。
  // Request $request ... フォームから送信されてきた値が渡ってくる
  // Contact $contact　... /admin/contacts/{contact}/toggle-completed
  //                      として、idが{contact}として渡ってきて、Laravelのその
  //                      idに見合った$contactを取得してくれる
  public function toggleCompleted(Request $request, Contact $contact) {
    // $contact = Contact::findOrFail($id); // ルートバインディングを使わずに、ルートから取得する

    // チェックあり → is_completed = true。なので DB には 1
    $contact->is_completed = $request->has("is_completed");

    $contact->save(); // MySQLに保存

    return to_route("admin.contacts.index")->with("success", "対応済みかどうかを変更しました。");
  }

}