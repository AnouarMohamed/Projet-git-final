<?php

namespace App\Services\TaskAdvisor;

use App\Enums\TaskPriority;
use Illuminate\Support\Str;

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

    /**
     * @param  array<string, mixed>  $payload
     */
    public static function fromArray(array $payload, string $provider): self
    {
        return new self(
            summary: Str::limit((string) ($payload['summary'] ?? 'Synthese indisponible.'), 600, ''),
            suggestedPriority: TaskPriority::tryFrom((string) ($payload['suggested_priority'] ?? 'medium')) ?? TaskPriority::Medium,
            estimatedMinutes: self::boundedMinutes($payload['estimated_minutes'] ?? 90),
            subtasks: self::stringList($payload['subtasks'] ?? [], ['Clarifier les prochaines etapes']),
            risks: self::stringList($payload['risks'] ?? [], ['Risque non precise']),
            provider: $provider,
        );
    }

    private static function boundedMinutes(mixed $value): int
    {
        return max(15, min(480, (int) $value));
    }

    /**
     * @param  list<string>  $fallback
     * @return list<string>
     */
    private static function stringList(mixed $value, array $fallback): array
    {
        if (! is_array($value)) {
            return $fallback;
        }

        $items = array_values(array_filter(
            array_map(fn (mixed $item): string => trim((string) $item), $value),
            fn (string $item): bool => $item !== '',
        ));

        return $items === [] ? $fallback : $items;
    }
}
