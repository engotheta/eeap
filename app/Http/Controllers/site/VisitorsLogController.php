<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VisitorsLog;
use Carbon\Carbon;

class VisitorsLogController extends BaseSiteController
{
    public function log(Request $request)
    {
        $client = VisitorsLog::where('browserId','=',$request->browserId)->get()->last();
        if($client && date('Y-m-d', strtotime($client->updated_at)) == date('Y-m-d')){
            //update the updated_at timestamp...
            $logs = $client->touch();
            if(!$logs) {
                return response()->json(['error'=>[
                    'status' => 401,
                    'message' => 'Bad Request',
                    'details' => 'Failed to record the log'
                ]],200);
            }
            $logs = $client;
        } else {
            //create new log
            $logs = VisitorsLog::create($request->all());
            if(!$logs) {
                return response()->json(['error'=>[
                    'status' => 401,
                    'message' => 'Bad Request',
                    'details' => 'Failed to record the log'
                ]],200);
            }
        }

        $data = [
			'online' => number_format($this->online()),
            'today' => number_format($this->today()),
            'yesterday' => number_format($this->yesterday()),
            'thisWeek' => number_format($this->thisWeek()),
            'thisMonth' => number_format($this->thisMonth()),
            'all' => number_format($this->all())
        ];
        return response()->json($data,200);
    }

    public function all()
    {
        return VisitorsLog::count();
    }

	public function online(){
		$now = Carbon::now();
		$startPrevTime = $now->subMinutes(5);

		return VisitorsLog::where("updated_at",'>',$startPrevTime)->count();
	}

    public function today(){
        return VisitorsLog::whereDate('created_at', '=', Carbon::today()->toDateString())->count();
    }

    public function yesterday(){
        return VisitorsLog::whereDate('created_at', '=', Carbon::yesterday()->toDateString())->count();
    }

    public function thisWeek(){
        $now = Carbon::now();
        $startDate = $now->startOfWeek()->toDateString();
        $endDate = $now->endOfWeek()->toDateString();

        return VisitorsLog::whereBetween("created_at",[$startDate,$endDate])->count();
    }

    public function thisMonth(){
        return VisitorsLog::whereMonth("created_at","=",date("m"))->count();
    }

    public function thisYear(){
        return VisitorsLog::whereYear("created_at","=",date("Y"))->count();
    }

    public function visitors(){
        return VisitorsLog::count();
    }
}