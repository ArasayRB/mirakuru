<?php

namespace App\Traits;
use App\Models\Keyword;

trait KeywordTrait {
    public function store($keyword) {
        // Fetch all the users from the 'users' table.
        $keywords = new Keyword();
        $keywords->name=$keyword;
        $keywords->save();
        return $keywords;
    }

    public function getKeywordIf($keyword){
      $keywords = Keyword::firstOrCreate(['name'=>$keyword],['name'=>$keyword]);

                   return $keywords;
    }

    public function getAllKeyword(){
      $keywords = Keyword::all();

                   return $keywords;
    }
}
