<?php

namespace App\Enums;

enum SupplierType: string
{
    case DISTRIBUIDOR = 'distribuidor';

    case MAYORISTA = 'mayorista';

    case PRODUCTOR = 'productor';

    public function label(): string
    {
        return match ($this) {
            self::DISTRIBUIDOR => __('Distribuidor'),
            self::MAYORISTA => __('Mayorista'),
            self::PRODUCTOR => __('Productor'),
        };
    }
}
