<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $language=new Language();
      $language->language='Spanish';
      $language->sigla='es';
      $language->save();

      $language=new Language();
      $language->language='English';
      $language->sigla='en';
      $language->save();
    }
}
