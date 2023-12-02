<?php

namespace App\Http\Controllers\User;

use App\Charts\Participant\DailyParticipantChart;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DailyParticipantChart $chart)
    {
        $components = [
            'page' => [
                'title' => 'Dashboard',
                'subtitle' => 'Dashboard'
            ],
            'participants' => [
                'all' => Participant::count(),
                'active' => Participant::whereIn('status', ['approved', 'success'])->count(),
            ],
            'chart' => $chart->build(),
        ];
        return view('user.dashboard', $components);
    }
}
