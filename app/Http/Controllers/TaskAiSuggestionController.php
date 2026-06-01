<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskAdvisor\TaskAdvisorInterface;
use Illuminate\Http\RedirectResponse;

class TaskAiSuggestionController extends Controller
{
    public function store(Task $task, TaskAdvisorInterface $advisor): RedirectResponse
    {
        $suggestion = $advisor->suggest($task);

        $task->aiSuggestions()->create($suggestion->toDatabasePayload());

        return redirect()
            ->route('tasks.show', $task)
            ->with('status', 'Suggestion IA generee et sauvegardee.');
    }
}
