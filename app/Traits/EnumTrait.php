<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Collection;

trait EnumTrait
{
    public static function toAssociativeArray(): array
    {
        foreach (self::cases() as $case) {
            $array[$case->name] = $case->value;
        }

        return $array;
    }

    public static function toArray(): array
    {
        return array_values(self::toAssociativeArray());
    }

    public static function getCollection(): Collection
    {
        return collect(self::toArray());
    }
}
