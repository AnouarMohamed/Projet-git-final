<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Models\Task;
use App\Models\TaskAiSuggestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaskAiSuggestion>
 */
class TaskAiSuggestionFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estimated_minutes' => fake()->numberBetween(30, 240),
            'provider' => 'demo',
            'risks' => [
                fake()->sentence(),
            ],
            'subtasks' => [
                fake()->sentence(),
                fake()->sentence(),
            ],
            'suggested_priority' => fake()->randomElement(TaskPriority::cases()),
            'summary' => fake()->paragraph(),
            'task_id' => Task::factory(),
        ];
    }
}
