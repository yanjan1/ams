<?php

namespace Database\Seeders;

use App\Models\Email;
use App\Models\EmailId;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    public function run(): void
    {
        EmailId::factory()->count(20)->create();

        Email::factory()->count(10)->create()->each(function ($email) {
            $receiverIds = EmailId::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $email->receivers()->attach($receiverIds);
        });
    }
}
