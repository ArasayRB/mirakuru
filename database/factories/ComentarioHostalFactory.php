<?php

namespace Database\Factories;

use App\Models\ComentarioHostal;
use App\Models\Hostal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioHostalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComentarioHostal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantHostal=Hostal::all()->count();
      $cantUser=User::all()->count();
      $gender=array('female','male');
      $randomGender=$this->faker->randomElement($gender);
        return [
          'user_id' => $this->faker->numberBetween(1,$cantUser),
          'comment' => $this->faker->text,
          'url_video' => $this->faker->url,
          'hostal_id' => $this->faker->numberBetween(1,$cantHostal),
        ];
    }
}
