<?php

namespace Database\Factories;

use App\Models\PublicacionHostal;
use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicacionHostalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublicacionHostal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

    $cantHostal=Hostal::all()->count();
      return [
        'title' => $this->faker->jobTitle,
        'content' => $this->faker->paragraph,
        'img_url'=>$this->faker->url,
        'video_url' =>$this->faker->url,
        'qr_img_url'=>$this->faker->url,
        'publicate_state' => $this->faker->boolean,
        'hostal_id'=>$this->faker->numberBetween(1,$cantHostal),
        'tags' => $this->faker->text($maxNbChars = 50),
        'slug' => $this->faker->text($maxNbChars = 50),
        'keywords' => $this->faker->text($maxNbChars = 50),
      ];
    }
}
