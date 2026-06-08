<?php

namespace App\Services\Tasks;

readonly class TaskStats
{
    public function __construct(
        public int $done,
        public int $progress,
        public int $todo,
        public int $total,
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
