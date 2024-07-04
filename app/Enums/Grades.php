<?php

namespace App\Enums;

enum Grades: int
{
    case GRADO40 = 40;
    case GRADO50 = 50;
    case GRADO60 = 60;
    case GRADO70 = 70;
    case GRADO80 = 80;

    public function label(): string
    {
        return match ($this) {
            self::GRADO40 => __('40'),
            self::GRADO50 => __('50'),
            self::GRADO60 => __('60'),
            self::GRADO70 => __('70'),
            self::GRADO80 => __('80'),
        };
    }
}
