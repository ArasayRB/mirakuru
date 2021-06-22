<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(PermissionTableSeeder::class);
      $this->call(RoleTableSeeder::class);
      $this->call(UserTableSeeder::class);
      $this->call(TemporadaTableSeeder::class);
      $this->call(CountrySeeder::class);
      $this->call(CamasTableSeeder::class);
      $this->call(WhyBlockedDateTableSeeder::class);
      $this->call(BlockedDateTableSeeder::class);
      $this->call(CategoriaHabitacionTableSeeder::class);
      $this->call(CategoriaPostTableSeeder::class);
      $this->call(HostalTableSeeder::class);
      $this->call(ServicioTableSeeder::class);
      $this->call(HabitacionTableSeeder::class);
      $this->call(ContentTypeTableSeeder::class);
      $this->call(LanguageTableSeeder::class);
      $this->call(CalificacionCommentPostTableSeeder::class);
      $this->call(CalificacionCommentHostalTableSeeder::class);
      $this->call(IndiceComentarioHostalTableSeeder::class);
      $this->call(TemaNoticiaTableSeeder::class);
      $this->call(NoticiaTableSeeder::class);
      $this->call(AreaPictureTableSeeder::class);
      $this->call(FotoTableSeeder::class);
      $this->call(ClosePlaceTableSeeder::class);
      $this->call(FacilityTableSeeder::class);
      $this->call(OwnerTableSeeder::class);
    }
}
