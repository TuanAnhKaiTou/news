<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrCreate(
            ['username' => 'test'],
            [
                'password' => Hash::make('123456'),
                'role_id'  => 3
            ]
        );
    }
}
