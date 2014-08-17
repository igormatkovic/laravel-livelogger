<?php namespace Igormatkovic\Livelogger\Facades;

use Illuminate\Support\Facades\Facade;

class Livelogger extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'log'; }

}
