<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

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

        $status = $this->faker->randomElement(['available', 'booked']);

        // Calculate the end time
        $end_time = date('H:i', strtotime("+{$duration} minutes", strtotime($start_time)));

        // Assign a random patient to booked appointments, otherwise, set patient_id to null
        $patient_id = $status === 'booked' ? Patient::inRandomOrder()->first()->id : null;

        // Log::info('Factory appointment data', [
        //     'status' => $status,
        //     'patient_id' => $patient_id,
        // ]);

        // Log::info('Generated appointment', [
        //     'start_time' => $start_time,
        //     'end_time' => $end_time,
        // ]);

        return [
            'schedule_id' => $schedule->id,
            'patient_id' => $patient_id, 
            'provider_id' => $schedule->provider_id,
            'service_id' => Service::inRandomOrder()->first()->id,
            'date' => $schedule->date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => $status,
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
        // Log::info('Generating start times', [
        //     'schedule start' => $start,
        //     'schedule end' => $end,
        //     'duration' => $duration,
        // ]);

        $startTimes = [];
        $current = strtotime($start);
        $end = strtotime($end);

        // Ensure the start time is aligned to the nearest 15-minute interval
        $current = ceil($current / (15 * 60)) * (15 * 60);

        // Generate start times within the schedule's time range
        while ($current + $duration * 60 <= $end) {
            $startTimes[] = date('H:i', $current);
            $current = strtotime('+15 minutes', $current);
        }

        // Log::info('Generated start times', ['startTimes' => $startTimes]);

        return $startTimes;
    }
}
