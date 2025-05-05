<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create 10 regular users
        $fac = Role::where('name', 'faculty')->first();
        $std = Role::where('name', 'student')->first();
        $deo = Role::where('name', 'DEO')->first();

        User::factory(10)->create()->each(function($user) use ($std){
            $user->roles()->attach($std);
        });

        User::factory(10)->create()->each(function($user) use ($fac){
            $user->active = false;
            $user->login_allow = true;
            $user->save();
            $user->roles()->attach($fac);
        });

        // Create an admin user with the 'admin' state
        User::factory()->DEO()->create([
            'email' => 'deo@ams.in',
            'password' => bcrypt('password'), // Ensure this is hashed
            'active' => false,
            'login_allow' => true,
        ])->roles()->attach($deo);
    }
}
