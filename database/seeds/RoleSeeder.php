<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        Role::firstOrCreate([
            'name'  => 'super-admin'
        ]);

        Role::firstOrCreate([
            'name'  => 'admin'
        ]);

        Role::firstOrCreate([
            'name'  => 'user'
        ]);
    }
}
