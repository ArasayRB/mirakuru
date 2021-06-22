<?php
namespace App\Traits;
use App\Models\CategoriaPost;

trait CategoryPostTrait {

  
  public function allCategories(){
    $categories=CategoriaPost::all();
  return  $categories;
  }

}
