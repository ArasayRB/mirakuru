<?php

namespace App\Traits;
use App\Models\Translate;

trait TranslateTrait {
    public function storeTranslate($data) {
        // Fetch all the users from the 'users' table
        foreach ($data as $dat) {
          $translate = new Translate();
          $translate->id_content_trans=$dat['id_content_trans'];
          $translate->content=$dat['content'];
          $translate->tipo_content=$dat['tipo_content'];
          $translate->trans_lang=$dat['trans_lang'];
          $translate->indice_content=$dat['indice_content'];
          $translate->content_trans=$dat['content_trans'];
          $translate->save();
        }

        return $translate;
    }


}
