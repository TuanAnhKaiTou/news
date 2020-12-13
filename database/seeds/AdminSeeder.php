<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Admin::truncate();
        Schema::enableForeignKeyConstraints();
        Admin::firstOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('123456'),
                'role_id'  => 1,
                'full_name' => 'Super Admin'
            ]
        );
    }
}
