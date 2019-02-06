<?php

namespace saeedphr\imail\Facades;

use Illuminate\Support\Facades\Facade;

class imail extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'imail';
    }
}
