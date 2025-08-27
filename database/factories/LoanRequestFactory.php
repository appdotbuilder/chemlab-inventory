<?php

namespace Database\Factories;

use App\Models\Laboratory;
use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanRequest>
 */
class LoanRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, $startDate->format('Y-m-d') . ' +1 week');

        return [
            'request_number' => LoanRequest::generateRequestNumber(),
            'user_id' => User::factory(),
            'laboratory_id' => Laboratory::factory(),
            'start_datetime' => $startDate,
            'end_datetime' => $endDate,
            'purpose' => $this->faker->text(200),
            'jsa_document' => 'jsa/jsa-document-' . $this->faker->uuid() . '.pdf',
            'status' => $this->faker->randomElement([
                'draft', 'submitted', 'awaiting_lecturer_approval', 
                'awaiting_lab_approval', 'approved', 'rejected'
            ]),
            'lecturer_supervisor_id' => $this->faker->optional()->randomElement(
                User::where('role', 'lecturer')->pluck('id')->toArray()
            ),
            'lecturer_approved_at' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
            'lecturer_notes' => $this->faker->optional()->text(100),
            'lab_approved_by' => $this->faker->optional()->randomElement(
                User::whereIn('role', ['lab_assistant', 'head_of_lab'])->pluck('id')->toArray()
            ),
            'lab_approved_at' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
            'lab_notes' => $this->faker->optional()->text(100),
            'rejection_reason' => $this->faker->optional()->text(150),
            'fine_amount' => 0,
        ];
    }

    /**
     * Indicate that the loan request is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'lecturer_approved_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'lab_approved_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ]);
    }

    /**
     * Indicate that the loan request is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => $this->faker->randomElement(['submitted', 'awaiting_lecturer_approval', 'awaiting_lab_approval']),
        ]);
    }
}