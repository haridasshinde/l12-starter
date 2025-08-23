<?php

namespace App\Enums;

enum SearchTarget: string
{
    case NAME = 'name';
    case EMAIL = 'email';
    case PHONE = 'phone';

    /**
     * Check if a value is a valid target
     */
    public static function isValid(string $value): bool
    {
        return in_array($value, array_column(self::cases(), 'value'));
    }
}
