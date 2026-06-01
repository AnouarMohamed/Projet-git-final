<?php

namespace App\Services\TaskAdvisor;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;

class DemoTaskAdvisor
{
    public function suggest(Task $task): TaskSuggestionData
    {
        $priority = $this->suggestPriority($task);
        $estimatedMinutes = $this->estimateMinutes($task, $priority);

        return new TaskSuggestionData(
            summary: $this->summary($task, $priority),
            suggestedPriority: $priority,
            estimatedMinutes: $estimatedMinutes,
            subtasks: $this->subtasks($task),
            risks: $this->risks($task),
            provider: 'demo',
        );
    }

    private function estimateMinutes(Task $task, TaskPriority $priority): int
    {
        $base = match ($priority) {
            TaskPriority::Low => 45,
            TaskPriority::Medium => 90,
            TaskPriority::High => 150,
            TaskPriority::Urgent => 210,
        };

        if ($task->description !== null && str_word_count($task->description) > 60) {
            $base += 45;
        }

        return $base;
    }

    private function suggestPriority(Task $task): TaskPriority
    {
        if ($task->priority === TaskPriority::Urgent || $task->isLate()) {
            return TaskPriority::Urgent;
        }

        if ($task->due_date !== null && $task->due_date->diffInDays(now(), false) >= -2) {
            return TaskPriority::High;
        }

        return $task->priority;
    }

    private function summary(Task $task, TaskPriority $priority): string
    {
        $status = $task->status === TaskStatus::Done ? 'deja terminee' : 'a traiter';

        return "La tache \"{$task->title}\" est {$status}. Priorite conseillee: {$priority->label()}.";
    }

    /**
     * @return list<string>
     */
    private function subtasks(Task $task): array
    {
        return [
            "Clarifier le resultat attendu pour {$task->title}",
            'Decouper le travail en etapes demonstrables',
            'Verifier le rendu final avec un scenario de demo',
        ];
    }

    /**
     * @return list<string>
     */
    private function risks(Task $task): array
    {
        $risks = [
            'Perte de temps si le perimetre change sans decision claire',
        ];

        if ($task->due_date === null) {
            $risks[] = 'Absence de date limite pour prioriser le travail';
        }

        if ($task->description === null || trim($task->description) === '') {
            $risks[] = 'Description trop courte pour estimer avec precision';
        }

        return $risks;
    }
}
