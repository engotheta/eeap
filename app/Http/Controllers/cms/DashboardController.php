<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\VisitorsLog;
use DB;
class DashboardController extends BaseController {


    public function __construct()
    {
        $this->visitorController = app('App\Http\Controllers\site\VisitorsLogController');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $today = $this->visitorController->today();
        $yesterday = $this->visitorController->yesterday();
        $this_week = $this->visitorController->thisWeek();
        $this_month = $this->visitorController->thisMonth();
        $this_year = $this->visitorController->thisYear();
        $visitors = $this->visitorController->visitors();

        $visitors_per_browser = DB::table('visitors_logs')
            ->select('browserName', DB::raw('count(*) as total'))
            ->groupBy(['browserName','created_at'])
            ->get();

        // dd($visitors_per_month);
        $data = [
            'today'=>$today,
            'yesterday'=>$yesterday,
            'this_week'=>$this_week,
            'this_month'=>$this_month,
            'this_year'=>$this_year,
            'visitors'=>$visitors,
            'visitors_per_browser'=>$visitors_per_browser
        ];

        return view('cms.dashboard.index',$data);
    }

}
