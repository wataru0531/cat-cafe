<?php

// ✅ 管理者向けのお問い合わせのコントローラ

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

// class AdminContactController extends Controller {
  
//   public function index() {
//     return view("admin.contacts.index");
//   }

//   public function detail(string $id) {
//     return view("admin.contacts.detail");
//   }
// }

class AdminContactController extends Controller {
  // お問い合わせ一覧
  public function index()
  {
      $contacts = Contact::latest()->get();

      return view('admin.contacts.index', compact('contacts'));
  }

  // お問い合わせ詳細
  public function detail(Contact $contact)
  {
      return view('admin.contacts.detail', compact('contact'));
  }
}