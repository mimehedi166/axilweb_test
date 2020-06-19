<?php namespace App\Repositories\Api\CallLogs;


use App\CallLogs;

class EloquentCallLogsRepository implements CallLogsRepository
{
    public function getDetails($request)
    {
        // TODO: Implement getDetails() method.
        $query = CallLogs::orderBy("id","ASC");
            if ($request->get('status'))
            {
                $query = $query->where('status', $request->get('status'));
            }
        $query = $query->get();
        return $query;
    }
}
