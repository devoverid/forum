<?php

use App\Models\Discussion;
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
        factory(Discussion::class, 12)->create();
    }
}
