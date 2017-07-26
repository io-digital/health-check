<?php

namespace IoDigital\HealthCheck;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HealthCheck
{
    public function __construct()
    {
        //
    }

    /**
     * Query application health
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus()
    {
        return response()->json($this->performChecks(), 200);
    }

    /**
     * Check if database is connected
     *
     * @return array
     */
    private function databaseTest()
    {
        try {
            $pdo = DB::connection()->getPdo();

            return [
                'database' => [
                    'message' => 'Database is connected.',
                    'success' => true,
                ]
            ];
        } catch (\Exception $e) {
            Log::error('HealthCheck Database Error -- ' . $e->getMessage() . ' --');

            return [
                'database' => [
                    'message' => 'There was an error connecting to the database. Error has been logged.',
                    'success' => false,
                ]
            ];
        }
    }

    /**
     * Check if application is running
     *
     * @return array
     */
    private function applicationTest()
    {
        return [
            'application' => [
                'message' => 'Application is running',
                'success' => true,
            ]
        ];
    }

    /**
     * Only when using SSL, is 'HTTP_X_FORWARDED_PROTO' is set to https
     *
     * @return array
     */
    private function sslTest()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            return [
                'ssl' => [
                    'message' => 'SSL is working.',
                    'success' => true
                ]
            ];
        } else {
            return [
                'ssl' => [
                    'message' => 'SSL is not working.',
                    'success' => false
                ]
            ];
        }
    }

    /**
     * Check and perform selected health checks
     *
     * @return array
     */
    private function performChecks()
    {
        $ssl = $database = $application = [];

        if (config('healthcheck.ssl') === true) {
            $ssl = $this->sslTest();
        }

        if (config('healthcheck.application') === true) {
            $database = $this->databaseTest();
        }

        if (config('healthcheck.database') === true) {
            $application = $this->applicationTest();
        }

        return array_merge($application, $database, $ssl);
    }
}