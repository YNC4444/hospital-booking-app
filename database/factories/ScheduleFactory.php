<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a random start and end time
        $validStartTimes = ['07:00', '13:00', '15:00'];
        $validEndTimes = ['13:00', '15:00', '20:00'];

        // Randomly select a start time
        $start_time = $this->faker->randomElement($validStartTimes);

        // filter end times to ensure a minimum schedule of 5 hours
        $filteredEndTimes = array_filter($validEndTimes, function ($end_time) use ($start_time) {
            return strtotime($end_time) - strtotime($start_time) >= 5 * 60 * 60;
        });

        $end_time = $this->faker->randomElement($filteredEndTimes);
        
        // generate a random date between +/- 1 year from today
        $date = $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d');

        return [
            // Create a new provider if not provided
            'provider_id' => Provider::factory(), 
            // 'day_of_week' => fake()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => fake()->randomElement(['available', 'booked']),
        ];
    }
}
