<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hostal;
use App\Models\Keyword;
use App\Models\BlockedDate;
use Conner\Tagging\Taggable;
use Carbon\Carbon;

class HostalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $blockedDate1=BlockedDate::where('description','Blocked before each book product COVID-19 for cleaning deep before arrive new guests')->first();
      $date_active = Carbon::now()->format('Y-m-d');
      $hostal=new Hostal();
      $hostal->name='Hostal Mirakuru Gran Familia';
      $hostal->phone='+5341993797';
      $hostal->address='Camilo Cienfuegos  #180A entre José Martí y Miguel Calzada';
      $hostal->img_ppal_url='mirakuruppal.jpg';
      $hostal->active=true;
      $hostal->email='hostalgranfamilia@gmail.com';
      $hostal->user_id='1';
      $hostal->tags='hostal trinidad, hostal mirakuru gran familia, turismo cuba';
      $hostal->slug='hostal-mirakuru-gran-familia';
      $hostal->keywords='hostal,turismo, trinidad, casa de renta';
      $hostal->save();
      $hostal->blockedDates()->attach($blockedDate1,array('active'=>true,'active_date'=>$date_active));

      $tags = explode(",", $hostal->tags);
      $hostal->tag($tags);

      $hostal=new Hostal();
      $hostal->name='Hostal Turmalina';
      $hostal->phone='+5352474269';
      $hostal->address='Calle C #22 entre Frank País y 1ra';
      $hostal->img_ppal_url='turmalinappal.jpg';
      $hostal->active=true;
      $hostal->email='hostalturmalina@gmail.com';
      $hostal->user_id='1';
      $hostal->tags='hostal trinidad, hostal turmalina, turismo cuba';
      $hostal->slug='hostal-turmalina';
      $hostal->keywords='hostal,turismo, trinidad, casa de renta';
      $hostal->save();

      $tags = explode(",", $hostal->tags);
      $hostal->tag($tags);
    }
}
