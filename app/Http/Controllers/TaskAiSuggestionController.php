<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskAdvisor\DemoTaskAdvisor;
use Illuminate\Http\RedirectResponse;

class TaskAiSuggestionController extends Controller
{
    public function store(Task $task, DemoTaskAdvisor $advisor): RedirectResponse
    {
        $suggestion = $advisor->suggest($task);

        $task->aiSuggestions()->create($suggestion->toDatabasePayload());

        return redirect()
            ->route('tasks.show', $task)
            ->with('status', 'Suggestion IA generee et sauvegardee.');
    }
}
