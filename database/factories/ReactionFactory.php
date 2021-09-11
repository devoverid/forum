<?php

namespace Database\Factories;

use App\Models\Reaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'reactionable_id' => 1,
            'reactionable_type' => 'App\Models\Discussion',
            'type' => 'upvote',
        ];
    }

    /**
     * Set user id.
     *
     * @param  mixed $id
     * @return static
     */
    public function setUserId($id)
    {
        return $this->state([
            'user_id' => $id,
        ]);
    }

    /**
     * Set the reactionable_id.
     *
     * @param  mixed $id
     * @return static
     */
    public function setReactionableId($id)
    {
        return $this->state([
            'reactionable_id' => $id
        ]);
    }

    /**
     * Set the reactionable_type.
     *
     * @param  mixed $type
     * @return static
     */
    public function setReactionableType($type)
    {
        return $this->state([
            'reactionable_type' => $type
        ]);
    }

    /**
     * Set the type.
     *
     * @param  mixed $type
     * @return static
     */
    public function setType($type)
    {
        return $this->state([
            'type' => $type
        ]);
    }
}
