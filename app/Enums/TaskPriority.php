<?php

namespace App\Enums;

enum TaskPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Urgent = 'urgent';

    public function label(): string
    {
        return match ($this) {
            self::Low => 'Basse',
            self::Medium => 'Moyenne',
            self::High => 'Haute',
            self::Urgent => 'Urgente',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Low => 'badge badge-neutral',
            self::Medium => 'badge badge-info',
            self::High => 'badge badge-warning',
            self::Urgent => 'badge badge-danger',
        };
    }
}
