<?php

namespace App\Http\Controllers;

use App\Repositories\Api\CallLogs\CallLogsRepository;
use Illuminate\Http\Request;


class CallLogsController extends Controller
{
    //Initialize the repository
    protected $log;
    public function __construct(CallLogsRepository $log)
    {
        $this->log = $log;
    }

    public function logDetails(Request $request)
    {
        $success = false;
        $status = 404;
        $msg = "Couldn't found any data.";
        $response = $this->log->getDetails($request);
        if (!empty($response))
        {
            $success = true;
            $status = 200;
            $msg = "Data Successfully Found.";
        }
        return response()->json(["success"=>$success, 'status' => $status, 'message'=>$msg,'data'=>$response]);
    }

    public function chartData(Request $request)
    {
        $success = false;
        $status = 404;
        $msg = "Couldn't found any data.";
        $response = $this->log->chartData($request);
        if (!empty($response))
        {
            $success = true;
            $status = 200;
            $msg = "Data Successfully Found.";
        }
        return response()->json(["success"=>$success, 'status' => $status, 'message'=>$msg,'data'=>$response]);
    }


}
