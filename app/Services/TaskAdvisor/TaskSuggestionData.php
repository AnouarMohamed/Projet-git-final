<?php

namespace App\Services\TaskAdvisor;

use App\Enums\TaskPriority;

final readonly class TaskSuggestionData
{
    /**
     * @param  list<string>  $subtasks
     * @param  list<string>  $risks
     */
    public function __construct(
        public string $summary,
        public TaskPriority $suggestedPriority,
        public int $estimatedMinutes,
        public array $subtasks,
        public array $risks,
        public string $provider,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toDatabasePayload(): array
    {
        return [
            'estimated_minutes' => $this->estimatedMinutes,
            'provider' => $this->provider,
            'risks' => $this->risks,
            'subtasks' => $this->subtasks,
            'suggested_priority' => $this->suggestedPriority,
            'summary' => $this->summary,
        ];
    }
}
