<?php

namespace Myckhel\Mono\Facades;

use Illuminate\Support\Facades\Facade;

class Mono extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'mono';
    }
}
