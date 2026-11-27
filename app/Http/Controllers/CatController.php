<?php

// ✅ catに関するコントローラ

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller {

  public function index() {
    $cats = Cat::latest()->paginate(6);

    return view('cats.index', [
      "cats" => $cats,
    ]);
  }

  public function show(string $catId) {
    $cat = Cat::findOrFail($catId);

    return view("cats.show", [
      "cat" => $cat,
    ]);
  }
}
