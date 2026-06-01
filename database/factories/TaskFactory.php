<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->paragraph(),
            'due_date' => fake()->dateTimeBetween('now', '+20 days'),
            'priority' => fake()->randomElement(TaskPriority::cases()),
            'status' => fake()->randomElement(TaskStatus::cases()),
            'title' => fake()->sentence(4),
        ];
    }
}
