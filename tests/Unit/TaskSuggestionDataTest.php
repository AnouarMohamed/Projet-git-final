<?php

namespace Tests\Unit;

use App\Enums\TaskPriority;
use App\Services\TaskAdvisor\TaskSuggestionData;
use PHPUnit\Framework\TestCase;

class TaskSuggestionDataTest extends TestCase
{
    public function test_it_normalizes_ai_payload(): void
    {
        $suggestion = TaskSuggestionData::fromArray([
            'estimated_minutes' => 999,
            'risks' => ['', 'Dependance non confirmee'],
            'subtasks' => ['Qualifier le besoin', 'Valider la demo'],
            'suggested_priority' => 'urgent',
            'summary' => str_repeat('a', 700),
        ], 'openai');

        $this->assertSame(TaskPriority::Urgent, $suggestion->suggestedPriority);
        $this->assertSame(480, $suggestion->estimatedMinutes);
        $this->assertSame(['Dependance non confirmee'], $suggestion->risks);
        $this->assertSame('openai', $suggestion->provider);
        $this->assertLessThanOrEqual(600, strlen($suggestion->summary));
    }
}
