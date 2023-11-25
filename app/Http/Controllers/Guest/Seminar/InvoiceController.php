<?php

namespace App\Http\Controllers\Guest\Seminar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        $components = [
            'page' => [
                'title' => 'Cari Faktur',
                'subtitle' => 'Invoice for our seminar'
            ]
        ];
        return view('guest.seminar.invoice', $components);
    }
}
