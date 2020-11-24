<?php

namespace Database\Factories;

use App\Models\CategoriaPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantUser=User::all()->count();
      $cantCatPost=CategoriaPost::all()->count();
        return [
          'title' => $this->faker->jobTitle,
          'content' => $this->faker->paragraph,
          'summary' => $this->faker->text($maxNbChars = 100),
          'publicate_state' => $this->faker->boolean,
          'img_url' => $this->faker->url,
          'video_url' => $this->faker->url,
          'qr_img_url'=> $this->faker->url,
          'user_id' => $this->faker->numberBetween(1,$cantUser),
          'category_id' => $this->faker->numberBetween(1,$cantCatPost),
          'cant_access_read' => $this->faker->randomDigitNotNull,
          'cant_likes' => $this->faker->randomDigitNotNull,
          'cant_shares' => $this->faker->randomDigitNotNull,
          'tags' => $this->faker->text($maxNbChars = 50),
        ];
    }
}
