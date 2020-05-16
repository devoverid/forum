<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 4)->create();
        // User::create([
        //     'name' => 'Alfian Dwi Nugraha',
        //     'username' => 'viandwi24',
        //     'email' => 'viandwicyber@gmail.com',
        //     'avatar' => '1.png',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ]);
    }
}
