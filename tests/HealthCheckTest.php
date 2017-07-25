<?php

namespace IoDigital\HealthCheck;

use Illuminate\Database\Connection;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class HealthCheckTest extends TestCase
{
    public function test_getStatus_method_fails_on_database_connection()
    {
        $obj = (new HealthCheck())->getStatus();

        $data = json_encode([
            "application" => [
                "message" => "Application is running",
                "success" => true
            ],
            "database" => [
                "message" => "There was an error connecting to the database.",
                "success" => false
            ]
        ]);

        $this->assertJsonStringEqualsJsonString($data, $obj->content());
    }

    public function test_getStatus_method_passes_database_connection()
    {
        DB::ge;
        $obj = (new HealthCheck())->getStatus();

        $data = json_encode([
            "application" => [
                "message" => "Application is running",
                "success" => true
            ],
            "database" => [
                "message" => "Database is connected.",
                "success" => false
            ]
        ]);

        $this->assertJsonStringEqualsJsonString($data, $obj->content());
    }
}
