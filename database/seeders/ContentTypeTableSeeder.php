<?php

namespace Database\Seeders;

use App\Models\ContentType;
use Illuminate\Database\Seeder;

class ContentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $content_type=new ContentType();
      $content_type->name='Post';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Noticia';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Oferta';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Publicacion Hostal';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Servicio';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Facility';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Close Place';
      $content_type->save();
    }
}
