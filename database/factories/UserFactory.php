<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = ['student', 'student', 'student', 'lecturer', 'lab_assistant'];
        $role = $this->faker->randomElement($roles);
        
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'student_id' => $role === 'student' ? $this->faker->unique()->numerify('##########') : null,
            'role' => $role,
            'status' => $this->faker->randomElement(['active', 'active', 'active', 'pending']),
            'phone' => $this->faker->phoneNumber(),
            'department' => $this->faker->randomElement([
                'Chemical Engineering',
                'Civil Engineering', 
                'Mechanical Engineering',
                'Electrical Engineering',
                'Industrial Engineering'
            ]),
            'faculty' => 'Faculty of Engineering',
            'address' => $this->faker->address(),
            'assigned_labs' => $role === 'lab_assistant' || $role === 'head_of_lab' ? 
                [$this->faker->numberBetween(1, 5)] : null,
            'approved_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'approved_by' => 1, // Assume admin user exists
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
