<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laboratory>
 */
class LaboratoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $labTypes = [
            'Analytical Chemistry Lab',
            'Organic Chemistry Lab', 
            'Physical Chemistry Lab',
            'Biochemistry Lab',
            'Materials Science Lab',
            'Process Engineering Lab',
            'Environmental Engineering Lab',
            'Thermodynamics Lab',
            'Fluid Mechanics Lab',
            'Heat Transfer Lab',
            'Mass Transfer Lab',
            'Reaction Engineering Lab'
        ];

        $operatingHours = [
            'monday' => ['start' => '08:00', 'end' => '17:00'],
            'tuesday' => ['start' => '08:00', 'end' => '17:00'],
            'wednesday' => ['start' => '08:00', 'end' => '17:00'],
            'thursday' => ['start' => '08:00', 'end' => '17:00'],
            'friday' => ['start' => '08:00', 'end' => '17:00'],
            'saturday' => ['start' => '09:00', 'end' => '15:00'],
            'sunday' => null,
        ];

        return [
            'name' => $this->faker->randomElement($labTypes),
            'code' => 'LAB-' . $this->faker->unique()->randomNumber(3),
            'description' => $this->faker->text(200),
            'location' => 'Building ' . $this->faker->randomElement(['A', 'B', 'C', 'D']) . ', Floor ' . $this->faker->numberBetween(1, 5),
            'capacity' => $this->faker->numberBetween(15, 50),
            'operating_hours' => $operatingHours,
            'blackout_dates' => [],
            'contact_person' => $this->faker->name(),
            'contact_email' => $this->faker->safeEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'image_gallery' => [
                'https://via.placeholder.com/800x600?text=Lab+Photo+1',
                'https://via.placeholder.com/800x600?text=Lab+Photo+2',
            ],
            'sop_documents' => [
                'sop/lab-safety-procedures.pdf',
                'sop/equipment-usage-guidelines.pdf',
            ],
            'rules' => 'Laboratory rules and regulations:\n1. Always wear appropriate PPE\n2. Follow safety protocols\n3. Clean workspace after use\n4. Report any incidents immediately',
            'status' => $this->faker->randomElement(['active', 'active', 'active', 'maintenance']),
        ];
    }

    /**
     * Indicate that the laboratory is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the laboratory is under maintenance.
     */
    public function maintenance(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'maintenance',
        ]);
    }
}