<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\Patient;
use App\Models\User;
use App\Models\Provider;
use App\Models\Schedule;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Patient::factory(10)->create();
        Provider::factory(10)->create()->each(function ($provider) {
            // create 1 to 5 schedules for each provider
            Schedule::factory(fake()->numberBetween(1, 5))->create([
                'provider_id' => $provider->id,
            ]);
        });
        
        admin::factory(10)->create();
    }
}
