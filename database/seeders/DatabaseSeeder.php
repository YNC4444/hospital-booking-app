<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // seed patients first
        Patient::factory(10)->create();
      
        // Define the possible services
        $serviceNames = ['Consultation', 'Diagnosis', 'Treatment', 'Prescription', 'Referral'];

        // Create services if they don't exist
        foreach ($serviceNames as $serviceName) {
            Service::firstOrCreate(['name' => $serviceName]);
        }

        // Fetch all services
        $services = Service::all();

        // Create providers and assign a random number of services
        Provider::factory()->count(10)->create()->each(function ($provider) use ($services) {
            $randomServices = $services->random(rand(1, 5))->pluck('id')->toArray();
            $provider->services()->sync($randomServices);

            // Create schedules and appointments for each provider
            Schedule::factory(fake()->numberBetween(1, 5))->create([
                'provider_id' => $provider->id,
            ])->each(function ($schedule) {
                // Create 1 to 3 appointments for each schedule
                Appointment::factory(fake()->numberBetween(1, 3))->create([
                    // Link appointment to a specific schedule
                    'schedule_id' => $schedule->id,
                    // Retrieve first record from randomly ordered list of patients
                    // and link appointment to that patient
                    'patient_id' => Patient::inRandomOrder()->first()->id,
                ]);
            });
            
            // generate schedules for the next month
            $nextMonthSchedules = Schedule::factory()->generateNextMonthSchedules($provider);

            foreach($nextMonthSchedules as $schedule) {
                $schedule->save();

                // Create 1 to 3 appointments for each schedule
                Appointment::factory((fake()->numberBetween(1, 3)))->create([
                    'schedule_id' => $schedule->id,
                    'patient_id' => Patient::inRandomOrder()->first()->id,
                ]);
            }
        });

        // Create admin users
        Admin::factory(10)->create();
    }
}
