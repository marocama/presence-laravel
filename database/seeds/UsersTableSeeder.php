<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Marcus Roberto',
            'email'     => 'marcus.rcm@outlook.com',
            'password'  => bcrypt('firefox4985'),

        ]);
    }
}
