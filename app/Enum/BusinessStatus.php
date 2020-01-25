<?php

namespace App\Enum;

class BusinessStatus
{
    const ACTIVE = 1;
    const UN_ACTIVE = 0;

    public static function lists()
    {
        return [
            self::ACTIVE => 'Active',
            self::UN_ACTIVE => 'UnActive'
        ];
    }
}