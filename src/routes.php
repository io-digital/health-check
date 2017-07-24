<?php

Route::get('/healthcheck', function () {
    return (new \IoDigital\HealthCheck\HealthCheck())->getStatus();
});