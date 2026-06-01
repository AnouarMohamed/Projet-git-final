<?php

namespace App\Services\Tasks;

final readonly class TaskStats
{
    public function __construct(
        public int $total,
        public int $todo,
        public int $progress,
        public int $done,
    ) {}

    /**
     * @return array<string, int>
     */
    public function toArray(): array
    {
        return [
            'done' => $this->done,
            'progress' => $this->progress,
            'todo' => $this->todo,
            'total' => $this->total,
        ];
    }
}
