<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Patient;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        // select random schedule from schedules table
        $schedule = Schedule::inRandomOrder()->first();
        
        // generate start_time between start_time and end_time of schedule
        $start_time = $this->faker->dateTimeBetween($schedule->start_time, $schedule->end_time)->format('H:i');
        
        $duration = $this->faker->randomElement([15, 30, 60]);

        // calculate end_time by adding duration to start_time
        $end_time = date('H:i', strtotime("{$duration} minutes", strtotime($start_time)));

        // if end_time is greater than schedule end_time, set end_time to schedule end_time
        if ($end_time > $schedule->end_time) {
            $end_time = $schedule->end_time;
        }

        return [
            'schedule_id' => $schedule->id,
            // generate a new patient if not provided
            'patient_id' => Patient::factory(),
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
    }
}
