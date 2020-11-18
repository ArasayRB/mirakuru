<?php

namespace Database\Factories;

use App\Models\TemaNoticia;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemaNoticiaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TemaNoticia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
