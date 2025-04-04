<?php

namespace Database\Seeders;

use App\Models\BankCard;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            BankCard::factory(rand(1, 3))->create([
                'user_uuid' => $user->user_uuid,
            ]);

            Level::factory()->create([
                'user_uuid' => $user->user_uuid,
            ]);
        });
    }
}
