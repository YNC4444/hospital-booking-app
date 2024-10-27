<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        // Get a random schedule
        $schedule = Schedule::inRandomOrder()->first();

        // Determine the duration of the appointment (15, 30, or 60 minutes)
        $duration = $this->faker->randomElement([15, 30, 60]);

        // Generate a random start time within the schedule's available time
        $start_time = $this->faker->dateTimeBetween($schedule->start_time, date('H:i', strtotime("-{$duration} minutes", strtotime($schedule->end_time))))->format('H:i');

        // Calculate the end time
        $end_time = date('H:i', strtotime("+{$duration} minutes", strtotime($start_time)));

        return [
            'schedule_id' => $schedule->id,
            // Create a new patient if not provided
            'patient_id' => Patient::factory(), 
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
    }
}
