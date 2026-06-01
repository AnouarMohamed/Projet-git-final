<?php

namespace App\Services\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;

class TaskStatsCalculator
{
    public function summary(): TaskStats
    {
        $counts = Task::query()
            ->selectRaw('status, count(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return new TaskStats(
            total: (int) $counts->sum(),
            todo: (int) ($counts[TaskStatus::Todo->value] ?? 0),
            progress: (int) ($counts[TaskStatus::InProgress->value] ?? 0),
            done: (int) ($counts[TaskStatus::Done->value] ?? 0),
        );
    }
}
