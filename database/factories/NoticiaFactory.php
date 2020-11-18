<?php

namespace Database\Factories;

use App\Models\Noticia;
use App\Models\TemaNoticia;
use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticiaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Noticia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantTema=TemaNoticia::all()->count();
      $cantHostal=Hostal::all()->count();
        return [
          'title' => $this->faker->jobTitle,
          'noticia' => $this->faker->paragraph,
          'publicate_state' => $this->faker->boolean,
          'cant_access_read' => $this->faker->randomDigitNotNull,
          'cant_likes' => $this->faker->randomDigitNotNull,
          'cant_shares' => $this->faker->randomDigitNotNull,
          'img_url'=>$this->faker->url,
          'video_url' =>$this->faker->url,
          'qr_img_url'=>$this->faker->url,
          'tema_id'=>$this->faker->numberBetween(1,$cantTema),
          'hostal_id'=>$this->faker->numberBetween(1,$cantHostal),
        ];
    }
}
