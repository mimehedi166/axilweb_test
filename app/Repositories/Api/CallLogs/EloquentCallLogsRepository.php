<?php namespace App\Repositories\Api\CallLogs;


use App\CallLogs;

class EloquentCallLogsRepository implements CallLogsRepository
{
    public function getDetails($request)
    {
        // TODO: Implement getDetails() method.
        $query = CallLogs::orderBy("call_date","ASC");
            if ($request->has('status') && !empty($request->get('status')))
            {
                $query = $query->where('status', $request->get('status'));
            }
            if ($request->has('from_date') && !empty($request->get('from_date')))
            {
                $fromDate = $request->get('from_date');
                $toDate = $request->get('from_date');
                if ($request->has('to_date') && !empty($request->get('to_date')))
                {
                    $toDate = $request->get('to_date');
                }
                $query = $query->whereBetween('call_date', [$fromDate, $toDate]);
            }
        $query = $query->get()->toArray();
        return $query;
    }
}
