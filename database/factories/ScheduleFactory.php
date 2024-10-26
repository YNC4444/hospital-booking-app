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
        $start_time = fake()->dateTimeBetween('07:00', '09:00')->format('H:i'); 
        $end_time = fake()->dateTimeBetween('15:00', '17:00')->format('H:i'); 

        return [
            // Create a new provider if not provided
            'provider_id' => Provider::factory(), 
            'day_of_week' => fake()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => fake()->randomElement(['available', 'booked']),
        ];
    }
}
