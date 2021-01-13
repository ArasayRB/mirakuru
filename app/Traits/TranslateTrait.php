<?php

namespace App\Traits;
use App\Models\Translate;
use Carbon\Carbon;

trait TranslateTrait {
    public function storeTranslate($data) {
        // Fetch all the users from the 'users' table
        foreach ($data as $dat) {
          $translate = new Translate();
          $translate->id_content_trans=$dat['id_content_trans'];
          $translate->content=$dat['content'];
          $translate->tipo_content=$dat['tipo_content'];
          $translate->indice_content=$dat['indice_content'];
          $translate->save();
          $translate->languages()->attach($dat['trans_lang'], array('content_trans'=>$dat['content_trans']));
        }

        return $translate;
    }

    public function updateTranslate($data) {
        // Fetch all the users from the 'users' table
                                   $translate_finded;

                                  foreach ($data as $dat) {
                                    $translate_finded=Translate::with('languages')
                                                               ->where('tipo_content',$dat['tipo_content'])
                                                               ->where('id_content_trans',$dat['id_content_trans'])
                                                               ->where('indice_content',$dat['indice_content'])
                                                               ->get();

                                     foreach ($translate_finded as $translated) {
                                       if($translated->languages[0]->id===$dat['trans_lang'] && $translated->id===$translated->languages[0]->pivot->translate_id){
                                             $date_updated=Carbon::now()->format('Y-m-d');
                                             $update_state= $translated->languages()->updateExistingPivot($translated->languages[0]->id,array('content_trans'=>$dat['content_trans'],'updated_at'=>$date_updated));

                                       }

                                     }

                                   }


        return $translate_finded;
    }

    public function getPostTranslatesById($idPost){
      $translate_post_array=[];
      $languages_array=[];
      $translate_post=Translate::with('languages')
                               ->where('id_content_trans',$idPost)
                               ->get();
      foreach ($translate_post as $translate) {
        $language=$translate->languages;
        $languages_array[]=$language;
        $translate_post_array[]=array(
          'content'=>$language[0]->pivot->content_trans,
          'indice_content'=>$translate->indice_content,
          'language'=>$language[0]->id,
        );
      }
                               return $translate_post_array;
    }

    public function getPostTranslatesLanguageById($idPost){
      $languages_array=[];
      $translate_post=Translate::with('languages')
                               ->where('id_content_trans',$idPost)
                               ->get();
      foreach ($translate_post as $translate) {
        $language=$translate->languages;

              if(array_search($language[0]->language,$languages_array)===false){
                $languages_array[]=$language[0]->language;
              }
      }
                               return $languages_array;
    }

    public function getTranslatedTransPost($id_lang,$post_id){
      $post=[];
      $translateds=Translate::with('languages')
                            ->where('id_content_trans',$post_id)
                            ->get();
        foreach ($translateds as $translated) {
          if($translated->languages[0]->id===$id_lang){
            $post[$translated->indice_content]=[
              'language_id'=>$translated->languages[0]->id,
              'language'=>$translated->languages[0]->language,
              'content_trans'=>$translated->languages[0]->pivot->content_trans
            ];
          }
        }
                            return $post;
    }


}
