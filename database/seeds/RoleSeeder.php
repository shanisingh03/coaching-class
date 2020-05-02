<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       App\Models\Role::create([
            'name' => "Superadmin",
            'status' => 1
        ]);
        App\Models\Role::create([
            'name' => "Admin",
            'status' => 1
        ]);
        App\Models\Role::create([
            'name' => "Teacher",
            'status' => 1
        ]);
        App\Models\Role::create([
            'name' => "Student",
            'status' => 1
        ]);
    }
}
