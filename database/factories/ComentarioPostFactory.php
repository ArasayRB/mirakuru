<?php

namespace Database\Factories;

use App\Models\CalificacionCommentPost;
use App\Models\ComentarioPost;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComentarioPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantCalification=CalificacionCommentPost::all()->count();
      $cantPost=Post::all()->count();
      $gender=array('female','male');
      $randomGender=$this->faker->randomElement($gender);
        return [
          'email' => $this->faker->email,
          'fullName' => $this->faker->name($gender = $randomGender),
          'comment' => $this->faker->text,
          'calification_id' => $this->faker->numberBetween(1,$cantCalification),
          'post_id' => $this->faker->numberBetween(1,$cantPost),
        ];
    }
}
