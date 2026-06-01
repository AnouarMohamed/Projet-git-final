<?php

namespace App\Http\Controllers;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $tasks = Task::query()
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('priority'), fn ($query) => $query->where('priority', $request->string('priority')))
            ->orderByRaw("CASE priority WHEN 'urgent' THEN 1 WHEN 'high' THEN 2 WHEN 'medium' THEN 3 ELSE 4 END")
            ->orderBy('due_date')
            ->orderByDesc('created_at')
            ->paginate(8)
            ->withQueryString();

        return view('tasks.index', [
            'priorities' => TaskPriority::cases(),
            'stats' => $this->stats(),
            'statuses' => TaskStatus::cases(),
            'tasks' => $tasks,
        ]);
    }

    public function create(): View
    {
        return view('tasks.create', $this->formData());
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $task = Task::query()->create($request->validated());

        return redirect()
            ->route('tasks.show', $task)
            ->with('status', 'Tache creee avec succes.');
    }

    public function show(Task $task): View
    {
        $task->load([
            'aiSuggestions' => fn ($query) => $query->latest(),
        ]);

        return view('tasks.show', [
            'latestSuggestion' => $task->aiSuggestions->first(),
            'task' => $task,
        ]);
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', [
            ...$this->formData(),
            'task' => $task,
        ]);
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()
            ->route('tasks.show', $task)
            ->with('status', 'Tache mise a jour.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Tache supprimee.');
    }

    /**
     * @return array<string, mixed>
     */
    private function formData(): array
    {
        return [
            'priorities' => TaskPriority::cases(),
            'statuses' => TaskStatus::cases(),
        ];
    }

    /**
     * @return array<string, int>
     */
    private function stats(): array
    {
        return [
            'total' => Task::query()->count(),
            'todo' => Task::query()->where('status', TaskStatus::Todo)->count(),
            'progress' => Task::query()->where('status', TaskStatus::InProgress)->count(),
            'done' => Task::query()->where('status', TaskStatus::Done)->count(),
        ];
    }
}
