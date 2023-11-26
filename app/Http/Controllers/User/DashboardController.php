<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $components = [
            'page' => [
                'title' => 'Dashboard',
                'subtitle' => 'Dashboard'
            ],
            'participants' => [
                'total' => Participant::count(),
            ]
        ];
        return view('user.dashboard', $components);
    }
}
