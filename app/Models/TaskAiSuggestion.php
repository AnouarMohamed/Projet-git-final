<?php

namespace App\Models;

use App\Enums\TaskPriority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
