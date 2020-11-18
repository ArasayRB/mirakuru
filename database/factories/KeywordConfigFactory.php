<?php

namespace Database\Factories;

use App\Models\KeywordConfig;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeywordConfigFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KeywordConfig::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'tipo_publicacion'=>$this->faker->jobTitle,
        'cant_max_words'=>$this->faker->numberBetween(1,5),
        'cant_min_words'=>$this->faker->numberBetween(1,2),
        ];
    }
}
