<?php

// database/factories/EmailFactory.php
namespace Database\Factories;

use App\Models\Email;
use App\Models\EmailId;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    protected $model = Email::class;

    public function definition(): array
    {
        return [
            'sender_id' => EmailId::inRandomOrder()->first()->id,
            'subject' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
    }
}
