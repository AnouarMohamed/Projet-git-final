<?php

namespace App\Services\TaskAdvisor;

use App\Models\Task;

interface TaskAdvisorInterface
{
    public function suggest(Task $task): TaskSuggestionData;
}
