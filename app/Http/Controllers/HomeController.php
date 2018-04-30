<?php

namespace App\Http\Controllers;

use Admitad\Api\Api;
use App\Services\AdmitadService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $admitadService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdmitadService $admitadService)
    {
        $this->middleware('auth');
        $this->admitadService  = $admitadService;
        $api = new Api();
        $scope = 'private_data_balance statistics';
        $api->selfAuthorize(env('ADMITAD_ID'),
            env('ADMITAD_SECRET'), $scope);
        $this->admitadService->api = $api;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statistic = $this->admitadService->getMonthStatistic();
        $balance = $this->admitadService->getAccountBalance();
        $todayProfit = $this->admitadService->getTodayProfit();
        $weekProfit = $this->admitadService->getWeekProfit();
        $todayLeads = $this->admitadService->getTodayLeads();

        return view('home',[
            'statistic'=>$statistic,
            'balance'=>$balance,
            'todayProfit'=>$todayProfit,
            'weekProfit'=>$weekProfit,
            'todayLeads'=>$todayLeads]);
    }
}
