<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\LoanRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanRequestItem>
 */
class LoanRequestItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'loan_request_id' => LoanRequest::factory(),
            'equipment_id' => Equipment::factory(),
            'quantity' => $this->faker->numberBetween(1, 3),
            'notes' => $this->faker->optional()->text(100),
            'condition_at_checkout' => $this->faker->optional()->randomElement([
                'excellent', 'good', 'fair', 'poor'
            ]),
            'condition_at_return' => $this->faker->optional()->randomElement([
                'excellent', 'good', 'fair', 'poor'
            ]),
            'damage_notes' => $this->faker->optional()->text(150),
        ];
    }
}