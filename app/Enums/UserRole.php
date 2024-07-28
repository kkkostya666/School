<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 1;
    case TEACHER = 2;
    case STUDENT = 3;

    public static function fromValue(int $value): self
    {
        return match ($value) {
            1 => self::ADMIN,
            2 => self::TEACHER,
            3 => self::STUDENT,
            default => throw new \InvalidArgumentException('Invalid role value'),
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Администратор',
            self::TEACHER => 'Учитель',
            self::STUDENT => 'Студент',
        };
    }
}
