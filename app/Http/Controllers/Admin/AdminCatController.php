<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;

class AdminCatController extends Controller {
  // 
  public function index() {
    $cats = Cat::latest()->paginate(10);

    return view("admin.cats.index", compact("cats"));
  }

  

}
