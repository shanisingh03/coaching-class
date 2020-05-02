<?php

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
        App\User::create([
            'first_name' => "Super",
            'last_name' => "Admin",
            'email' => "superadmin@coachingclass.in",
            'mobile' => "8668370257",
            'password' => Hash::make('Admin@123#'),
            'role_id'=>1
        ]);
    }
}
