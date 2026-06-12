<?php

namespace App\Models;

use App\Enums\TaskPriority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $task_id
 * @property string $summary
 * @property TaskPriority $suggested_priority
 * @property array $subtasks
 * @property array $risks
 * @property int $estimated_minutes
 * @property string $provider
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class TaskAiSuggestion extends Model
{
    protected $fillable = [
        'estimated_minutes',
        'provider',
        'risks',
        'subtasks',
        'suggested_priority',
        'summary',
    ];

    protected function casts(): array
    {
        return [
            'estimated_minutes' => 'integer',
            'risks' => 'array',
            'subtasks' => 'array',
            'suggested_priority' => TaskPriority::class,
        ];
    }

    /**
     * @return BelongsTo<Task, TaskAiSuggestion>
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
