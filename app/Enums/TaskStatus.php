<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Todo = 'todo';
    case InProgress = 'in_progress';
    case Done = 'done';

    public function label(): string
    {
        return match ($this) {
            self::Todo => 'A faire',
            self::InProgress => 'En cours',
            self::Done => 'Terminee',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Todo => 'badge badge-neutral',
            self::InProgress => 'badge badge-info',
            self::Done => 'badge badge-success',
        };
    }
}
