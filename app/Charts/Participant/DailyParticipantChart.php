<?php

namespace App\Charts\Participant;

use App\Models\Participant;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DailyParticipantChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $dateRange = list_date_range(date('Y-m-01'), date('Y-m-09'));

        $data = [];
        foreach ($dateRange as $key => $date) {
            $data['date'][]  = format_date($date);
            $data['all'][] = Participant::whereDate('created_at', $date)->count();
            $data['active'][] = Participant::whereIn('status', ['approved', 'success'])->whereDate('created_at', $date)->count();
        }

        return $this->chart->lineChart()
            ->setTitle('Grafik registrasi peserta.')
            ->setSubtitle('Grafik registrasi peserta.')
            ->addData('Total peserta', $data['all'])
            ->addData('Peserta tervalidasi', $data['active'])
            ->setXAxis($data['date'])
            ->setColors(['#6e81dc', '#71dd37'])
            ->setFontColor('#6e81dc');
    }
}
