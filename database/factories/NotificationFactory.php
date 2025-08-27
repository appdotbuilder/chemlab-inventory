<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'loan_request_submitted',
            'loan_request_approved',
            'loan_request_rejected',
            'equipment_due_reminder',
            'equipment_overdue',
            'account_approved',
            'system_maintenance',
        ];

        return [
            'type' => $this->faker->randomElement($types),
            'user_id' => User::factory(),
            'data' => [
                'title' => $this->faker->sentence(),
                'message' => $this->faker->text(200),
                'related_id' => $this->faker->optional()->randomNumber(),
                'icon' => $this->faker->randomElement(['📋', '✅', '❌', '⏰', '⚠️', '🔔']),
            ],
            'read_at' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
            'priority' => $this->faker->randomElement(['low', 'normal', 'high', 'urgent']),
            'action_url' => $this->faker->optional()->url(),
        ];
    }

    /**
     * Indicate that the notification is unread.
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'read_at' => null,
        ]);
    }

    /**
     * Indicate that the notification is high priority.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'high',
        ]);
    }
}