<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
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
        $title = $this->faker->unique()->sentence();
        return [
            'user_id' => '010e8f2b-8680-4816-8641-6e5b4844f7be',
            'title' => $title,
            'slug' => Str::slug($title),
            'meta_title' => $title,
            'meta_description' => $this->faker->sentence(),
            'meta_keyword' => $this->faker->word(),
            'body' => $this->faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
