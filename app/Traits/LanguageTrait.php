<?php

namespace App\Traits;
use App\Models\Language;

trait LanguageTrait {
    public function findLanguageName($id) {
        // Fetch all the users from the 'users' table.
        $translate = Language::find($id);
        return $translate;
    }


}
