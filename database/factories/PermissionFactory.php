<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $nameControl=$this->faker->word;
      $nameMethod=$this->faker->word;
      $permisison="".$nameControl.".".$nameMethod;
        return [
          'name' =>$permisison,
          'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
