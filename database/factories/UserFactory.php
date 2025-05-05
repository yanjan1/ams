<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

  
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // you can change this or make it dynamic
            'active' => $this->faker->boolean(50),
            'login_allow' => $this->faker->boolean(50)
            // Add other fields if necessary
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

     public function DEO()
     {
         return $this->state([
             'login_allow' => true, // AdmiWns can always login
         ]);
     }
}
