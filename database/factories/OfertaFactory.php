<?php

namespace Database\Factories;

use App\Models\Oferta;
use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfertaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Oferta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cantHostal=Hostal::all()->count();

        return [
              'name' => $this->faker->jobTitle,
              'description' => $this->faker->paragraph,
              'img_ppal_url'=>$this->faker->url,
              'qr_img_web_url'=>$this->faker->url,
              'active' => $this->faker->boolean,
              'price'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 200),
              'fecha_inicio' =>$this->faker->date($format = 'Y-m-d', $max = 'now'),
              'fecha_final'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
              'hostal_id'=>$this->faker->numberBetween(1,$cantHostal),
              'tags' => $this->faker->text($maxNbChars = 50),
              'slug' => $this->faker->text($maxNbChars = 50),
              'keywords' => $this->faker->text($maxNbChars = 50),          
        ];
    }
}
