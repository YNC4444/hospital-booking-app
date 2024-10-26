<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'specialization' => fake()->randomElement(['General Practitioner', 'Cardiologist', 'Dermatologist', 'Pediatrician', 'Neurologist']),
            // stores an array of services provided by the provider, in json string format
            'services' => json_encode(fake()->randomElements(['Consultation', 'Diagnosis', 'Treatment', 'Prescription', 'Referral'], fake()->numberBetween(1, 5))),
            // Example license number: AB123456
            'license_number' => fake()->regexify('[A-Z]{2}[0-9]{6}'),
            'employment_date' => fake()->date(),
            'status' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
