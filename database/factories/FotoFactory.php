<?php

namespace Database\Factories;

use App\Models\AreaPicture;
use App\Models\Hostal;
use App\Models\Foto;
use Illuminate\Database\Eloquent\Factories\Factory;

class FotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Foto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantArea=AreaPicture::all()->count();
      $cantHostal=Hostal::all()->count();
        return [
          'name'=>$this->faker->jobTitle,
          'description'=>$this->faker->paragraph,
          'img_url'=>$this->faker->url,
          'hostal_id'=>$this->faker->numberBetween(1,$cantHostal),
          'area_id'=>$this->faker->numberBetween(1,$cantArea),
        ];
    }
}
