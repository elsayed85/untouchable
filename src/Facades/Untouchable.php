<?php

namespace Elsayed85\Untouchable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Elsayed85\Untouchable\Untouchable
 */
class Untouchable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Elsayed85\Untouchable\Untouchable::class;
    }
}
