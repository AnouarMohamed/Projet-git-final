<?php

namespace App\Services\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;

class TaskStatsCalculator
{
    public function calculate(): TaskStats
    {
        return new TaskStats(
            done: Task::query()->where('status', TaskStatus::Done)->count(),
            progress: Task::query()->where('status', TaskStatus::InProgress)->count(),
            todo: Task::query()->where('status', TaskStatus::Todo)->count(),
            total: Task::query()->count(),
        );
    }
}
