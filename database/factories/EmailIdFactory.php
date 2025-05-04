<?php

namespace Database\Factories;

use App\Models\EmailId;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailIdFactory extends Factory
{
    protected $model = EmailId::class;

    public function definition(): array
    {
        return [
            'owner_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
