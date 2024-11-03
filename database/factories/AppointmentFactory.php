<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
// use Illuminate\Support\Facades\Log;

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

        // Generate a list of possible start times within the schedule's available time
        $startTimes = $this->generateCleanStartTimes($schedule->start_time, $schedule->end_time, $duration);

        // Log::info('Generated clean start times: ', $startTimes);
        // Randomly select a start time from the list
        $start_time = $this->faker->randomElement($startTimes);

        // Log::info("Selected start time: {$start_time}");

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

    /**
     * Generate an array of clean start times within a given time range.
     *
     * This function generates start times at 15-minute intervals between the specified
     * start and end times, ensuring that each start time allows for the specified duration.
     */
    private function generateCleanStartTimes($start, $end, $duration)
    {
        $startTimes = [];
        $current = strtotime($start);
        $end = strtotime($end);

        $current = ceil($current / (15 * 60)) * (15 * 60);

        while ($current <= $end - $duration * 60) {
            $startTimes[] = date('H:i', $current);
            $current = strtotime('+15 minutes', $current);
        }

        return $startTimes;
    }
}
