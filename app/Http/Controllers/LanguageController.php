<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
  public function switchLang($language)
  {
      // Almacenar el lenguaje en la session
      session()->put('locale', $language);
      return redirect()->back();
  }
}
