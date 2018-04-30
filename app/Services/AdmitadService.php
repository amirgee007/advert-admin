<?php
namespace App\Services;

use Admitad\Api\Api;

class AdmitadService
{
    public $api;

    public function __construct(Api $api= null)
    {
        $this->api = $api;
    }


    /**
     * Get balance in RUB.
     * @return bool
     * @throws \Admitad\Api\Exception\InvalidResponseException
     */
    public function getAccountBalance()
    {
        $balances = $this->api->get('/me/balance/')->getArrayResult();
        foreach ($balances as $balance)
        {
            if($balance['currency'] == "RUB" )
                return $balance['balance'];
        }

        return false;
    }

    public function getTodayProfit()
    {
        $yesterday = new \DateTime('yesterday');
        $twoDaysStatistic = $this->api->get('/statistics/dates/',[
            'website'=>env('ADMITAD_WEBSITE'),
            'date_start'=> $yesterday->format('d.m.Y')
        ])->getArrayResult()['results'];
        if(empty($twoDaysStatistic))
            return ['profit' => 0,'percent'=>0];
        $todayProfit = $twoDaysStatistic[0]['payment_sum_approved'];
        $yesterdayProfit = $twoDaysStatistic[1]['payment_sum_approved'];
        $percent = $this->countPercents($todayProfit,$yesterdayProfit);

        return ['profit'=>$todayProfit,'percent'=>$percent];
    }

    public function getTodayLeads()
    {
        $yesterday = new \DateTime('yesterday');
        $twoDaysStatistic = $this->api->get('/statistics/dates/',[
            'website'=>env('ADMITAD_WEBSITE'),
            'date_start'=> $yesterday->format('d.m.Y')
        ])->getArrayResult()['results'];
        if(empty($twoDaysStatistic))
            return ['leads' => 0,'percent'=>0];
        $todayLeads = $twoDaysStatistic[0]['leads_sum'];
        $yesterdayLeads = $twoDaysStatistic[1]['leads_sum'];
        $percent = $this->countPercents($todayLeads,$yesterdayLeads);

        return ['leads'=>$todayLeads,'percent'=>$percent];
    }


    public function getWeekProfit()
    {
        $thisMonday = new \DateTime('last Monday');
        $prevMonday = clone $thisMonday;
        $prevMonday = $prevMonday->modify('-7 days');

        $prevWeek = $this->api->get('/statistics/dates/',[
            'website'=>env('ADMITAD_WEBSITE'),
            'date_start'=> $prevMonday->format('d.m.Y'),
            'date_end'=>$thisMonday->format('d.m.Y')
        ])->getArrayResult()['results'];


        $thisWeek = $this->api->get('/statistics/dates/',[
            'website'=>env('ADMITAD_WEBSITE'),
            'date_start'=>$thisMonday->format('d.m.Y')
        ])->getArrayResult()['results'];
        if(empty($thisWeek) && empty($prevWeek))
            return ['profit' => 0,'percent'=>0];
        $prevWeekProfit = $this->countWeekProfit($prevWeek);
        $thisWeekProfit = $this->countWeekProfit($thisWeek);

        $percent = $this->countPercents($thisWeekProfit, $prevWeekProfit);

        return ['profit'=>$thisWeekProfit, 'percent' => $percent];
    }

    private function countPercents($today,$yesterday)
    {
        $percent = ($today*100)/$yesterday;

        return 100 - $percent;
    }

    private function countWeekProfit(array $days)
    {
        $profit = 0;
        foreach ($days as $day)
        {
            $profit += $day['payment_sum_approved'];
        }

        return $profit;
    }

    public function getMonthStatistic()
    {
        $start = new \DateTime('-21 days');
        $now = new \DateTime();
        $monthStatistic = $this->api->get('/statistics/dates/',[
            'website'=>env('ADMITAD_WEBSITE'),
            'date_start'=>$start->format('d.m.Y'),
            'date_end'=> $now->format('d.m.Y'),
            'limit'=>50
        ])->getArrayResult()['results'];
        $statistic = [];
        foreach ($monthStatistic as $item)
        {
            $date = new \DateTime($item['date']);
            $statistic[$date->format('d.m.Y')] = [
                'profit' => $item['payment_sum'] ?? 0,
                'clicks' => $item['clicks'],
                'leads'  => $item['leads_sum']
            ];
        }
        while ($start->format('d.m.Y') != $now->format('d.m.Y')){
            if(empty($statistic[$start->format('d.m.Y')])) {
                $statistic[$start->format('d.m.Y')] = [
                    'profit' => 0,
                    'clicks' => 0,
                    'leads' => 0
                ];
            }
            $start->modify('+1 day');
        }
        ksort($statistic,SORT_STRING );

        return $statistic;
    }
}