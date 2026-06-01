<?php

namespace Tests\Feature;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task(): void
    {
        $response = $this->post(route('tasks.store'), [
            'description' => 'Preparer la demonstration MVP avec le flux IA.',
            'due_date' => now()->addWeek()->format('Y-m-d'),
            'priority' => TaskPriority::High->value,
            'status' => TaskStatus::Todo->value,
            'title' => 'Preparer la demo',
        ]);

        $task = Task::query()->firstOrFail();

        $response->assertRedirect(route('tasks.show', $task));
        $this->assertDatabaseHas('tasks', [
            'priority' => TaskPriority::High->value,
            'status' => TaskStatus::Todo->value,
            'title' => 'Preparer la demo',
        ]);
    }

    public function test_user_can_update_task(): void
    {
        $task = Task::factory()->create([
            'status' => TaskStatus::Todo,
        ]);

        $response = $this->put(route('tasks.update', $task), [
            'description' => 'Version mise a jour.',
            'due_date' => now()->addDays(3)->format('Y-m-d'),
            'priority' => TaskPriority::Urgent->value,
            'status' => TaskStatus::InProgress->value,
            'title' => 'Tache ajustee',
        ]);

        $response->assertRedirect(route('tasks.show', $task));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'priority' => TaskPriority::Urgent->value,
            'status' => TaskStatus::InProgress->value,
            'title' => 'Tache ajustee',
        ]);
    }

    public function test_user_can_delete_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_invalid_task_data_is_rejected(): void
    {
        $response = $this->from(route('tasks.create'))->post(route('tasks.store'), [
            'description' => str_repeat('x', 2001),
            'due_date' => 'not-a-date',
            'priority' => 'critical',
            'status' => 'blocked',
            'title' => '',
        ]);

        $response
            ->assertRedirect(route('tasks.create'))
            ->assertSessionHasErrors(['description', 'due_date', 'priority', 'status', 'title']);
    }

    public function test_user_can_generate_demo_ai_suggestion(): void
    {
        config(['services.ai.provider' => 'demo']);

        $task = Task::factory()->create([
            'description' => 'Livrer une demo claire du MVP Laravel.',
            'priority' => TaskPriority::Medium,
            'status' => TaskStatus::Todo,
        ]);

        $response = $this->post(route('tasks.ai-suggestion.store', $task));

        $response->assertRedirect(route('tasks.show', $task));
        $this->assertDatabaseHas('task_ai_suggestions', [
            'provider' => 'demo',
            'task_id' => $task->id,
        ]);
    }
}
