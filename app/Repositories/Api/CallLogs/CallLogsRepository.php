<?php namespace App\Repositories\Api\CallLogs;

interface CallLogsRepository
{
    public function getDetails($request);
    public function chartData($request);
}
