<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $components = [
            'page' => [
                'title' => 'Homepage',
                'subtitle' => 'Welcome to our homepage'
            ]
        ];
        return view('guest.index', $components);
    }

    
}
