<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
  public function switchLang($language)
  {
      // Almacenar el lenguaje en la session
      session()->put('locale', $language);
      return redirect()->back();
  }

  public function getLanguagesList()
  {
    $language_list=Language::all();
    return $language_list;
  }
}
