<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $news = News::orderBy('created_at', 'desc')->take(5)->get();
        $components = [
            'page' => [
                'title' => 'Homepage',
                'subtitle' => 'Welcome to our homepage'
            ],
            'news' => $news
        ];
        return view('guest.index', $components);
    }


}
