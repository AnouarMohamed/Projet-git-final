<?php

namespace App\Services\TaskAdvisor;

use App\Models\Task;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenAiTaskAdvisor implements TaskAdvisorInterface
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $model,
        private readonly string $baseUrl,
    ) {}

    public function suggest(Task $task): TaskSuggestionData
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('OPENAI_API_KEY est requis quand AI_PROVIDER=openai.');
        }

        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->timeout(30)
            ->post($this->endpoint(), [
                'input' => $this->input($task),
                'model' => $this->model,
                'text' => [
                    'format' => [
                        'name' => 'task_suggestion',
                        'schema' => $this->schema(),
                        'type' => 'json_schema',
                    ],
                ],
            ])
            ->throw();

        $content = $this->extractOutputText($response->json());
        $payload = json_decode($content, true);

        if (! is_array($payload)) {
            throw new RuntimeException('La reponse IA ne contient pas un JSON exploitable.');
        }

        return TaskSuggestionData::fromArray($payload, 'openai');
    }

    private function endpoint(): string
    {
        return rtrim($this->baseUrl, '/').'/responses';
    }

    /**
     * @return array<int, array<string, string>>
     */
    private function input(Task $task): array
    {
        return [
            [
                'content' => 'Tu es un assistant de gestion de projet. Reponds uniquement en JSON conforme au schema.',
                'role' => 'system',
            ],
            [
                'content' => sprintf(
                    "Titre: %s\nDescription: %s\nStatut: %s\nPriorite actuelle: %s\nDate limite: %s",
                    $task->title,
                    $task->description ?: 'Non fournie',
                    $task->status->label(),
                    $task->priority->label(),
                    $task->due_date?->format('Y-m-d') ?? 'Non definie',
                ),
                'role' => 'user',
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function schema(): array
    {
        return [
            'additionalProperties' => false,
            'properties' => [
                'estimated_minutes' => [
                    'maximum' => 480,
                    'minimum' => 15,
                    'type' => 'integer',
                ],
                'risks' => [
                    'items' => ['type' => 'string'],
                    'maxItems' => 5,
                    'minItems' => 1,
                    'type' => 'array',
                ],
                'subtasks' => [
                    'items' => ['type' => 'string'],
                    'maxItems' => 6,
                    'minItems' => 2,
                    'type' => 'array',
                ],
                'suggested_priority' => [
                    'enum' => ['low', 'medium', 'high', 'urgent'],
                    'type' => 'string',
                ],
                'summary' => [
                    'maxLength' => 600,
                    'type' => 'string',
                ],
            ],
            'required' => ['summary', 'suggested_priority', 'estimated_minutes', 'subtasks', 'risks'],
            'type' => 'object',
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function extractOutputText(array $payload): string
    {
        if (is_string($payload['output_text'] ?? null)) {
            return $payload['output_text'];
        }

        foreach (($payload['output'] ?? []) as $output) {
            foreach (($output['content'] ?? []) as $content) {
                if (is_string($content['text'] ?? null)) {
                    return $content['text'];
                }
            }
        }

        throw new RuntimeException('La reponse IA ne contient pas de texte.');
    }
}
