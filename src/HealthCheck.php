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
     * Merge test messages
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus()
    {
        $application = $this->applicationTest();
        $database = $this->databaseTest();

        $status = array_merge($application, $database);

        return response()->json($status, 200);
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
}