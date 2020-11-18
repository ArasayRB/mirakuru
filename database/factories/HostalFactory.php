<?php

namespace Database\Factories;

use App\Models\Hostal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hostal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantUser=User::all()->count();
        return [
          'name' => $this->faker->jobTitle,
          'phone' => $this->faker->phoneNumber,
          'address' => $this->faker->address,
          'img_ppal_url' => $this->faker->url,
          'qr_img_web_url' => $this->faker->url,
          'active' => $this->faker->boolean,
          'email' => $this->faker->email,
          'user_id' => $this->faker->numberBetween(1,$cantUser),
        ];
    }
}
