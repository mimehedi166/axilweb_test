<?php namespace App\Repositories\Api\CallLogs;


use App\CallLogs;
use DB;

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
        $query = $query->paginate(50);
        return $query;
    }

    public function chartData($request)
    {
        // TODO: Implement chartData() method.
        $response = [];
        $conditionStatus = '';
        $conditionDateRange = " call_date BETWEEN `call` AND `call`";
        if ($request->has('status') && !empty($request->get('status')))
        {
            $conditionStatus = " AND status = '{$request->get('status')}'";
        }
        if ($request->has('from_date') && !empty($request->get('from_date')))
        {
            $fromDate = $request->get('from_date');
            $toDate = $request->get('from_date');
            if ($request->has('to_date') && !empty($request->get('to_date')))
            {
                $toDate = $request->get('to_date');
            }
            $conditionDateRange = " call_date between '{$fromDate}' AND '{$toDate}'";
        }

        $query = DB::select(
            "SELECT DISTINCT
                (call_date) AS `call`,
                (SELECT
                        COUNT(id)
                    FROM
                        call_logs
                    WHERE
                        {$conditionDateRange} {$conditionStatus}) AS call_count
            FROM
                call_logs
            ORDER BY call_date ASC;"
        );

        //Custom response to load map data
        if (!empty($query))
        {
            foreach ($query AS $item)
            {
                $response[$item->call] = $item->call_count;
            }

        }
        return $response;
    }
}
