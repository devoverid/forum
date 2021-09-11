<?php

namespace Database\Seeders;

use App\Models\Discussion;
use App\Models\Reaction;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discussion::factory()
            ->count(10)
            ->setUserId(1)
            ->create();
        Reaction::factory()
            ->count(1)
            ->setUserId(1)
            ->setReactionableType('App\Models\Discussion')
            ->setReactionableId(1)
            ->setType('upvote')
            ->create();
    }
}
