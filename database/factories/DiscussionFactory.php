<?php

namespace Database\Factories;

use App\Models\Discussion;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discussion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
            'user_id' => 1,
        ];
    }

    /**
     * Define the model's state for the "published" factory.
     *
     * @param  mixed $id
     * @return static
     */
    public function setUserId($id)
    {
        return $this->state([
            'user_id' => $id
        ]);
    }
}
