<?php

namespace App\Enums;

enum AnimalType: string
{
    case Perro = 'perro';
    case Gato  = 'gato';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::Perro->value => 'Perro',
            self::Gato->value  => 'Gato',
        ];
    }

    public function label(): string
    {
        return self::labels()[$this->value];
    }
}
