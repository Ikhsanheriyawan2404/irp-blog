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
        $user = User::where('id', '');
        $title = $this->faker->unique()->sentence();
        return [
            'user_id' => '8768ddc8-7de7-4233-a6cc-907c7ba4421f',
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
