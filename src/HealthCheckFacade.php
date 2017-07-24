<?php

namespace IoDigital\HealthCheck;

use Illuminate\Support\Facades\Facade;

class HealthCheckFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'iodigital-healthcheck';
    }
}
