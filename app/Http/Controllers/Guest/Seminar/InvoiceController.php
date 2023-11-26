<?php

namespace App\Http\Controllers\Guest\Seminar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        $components = [
            'page' => [
                'title' => (request()->segment(3) == null) ? 'Cari Faktur' : 'Faktur ' . request()->segment(3),
                'subtitle' => 'Invoice for our seminar'
            ]
        ];
        return view('guest.seminar.invoice', $components);
    }

}
