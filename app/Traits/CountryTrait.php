<?php
namespace App\Traits;
use App\Models\Country;

trait CountryTrait {

  public function getAllCountries(){
    return Country::all();
  }
}
