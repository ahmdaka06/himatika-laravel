<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UniversityController extends Controller
{
    public function index() {
        if (!request()->ajax() || request()->__m <> '__searchInstitutional' || !request()->has('q')) return abort(400);

        $search = request()->q;

        $arr = [];
        // $response = Http::get('https://api-frontend.kemdikbud.go.id/hit/' . $search);
        // if ($response->status()) {
        //     $result = json_decode($response->body(), true);

        //     foreach ($result['pt'] as $key => $value) {
        //         $arr[] = [
        //             'id' => $this->getNPSN($value['text']),
        //             'text' => $value['text'],
        //         ];
        //     }
        // }
        array_push($arr, [
            'id' => 1,
            'text' => 'Umum',
        ]);
        array_push($arr, [
            'id' => 071023,
            'text' => 'Universitas Darul Ulum Jombang',
        ]);
        array_push($arr, [
            'id' => 2,
            'text' => 'Lainnya',
        ]);
        return $arr;
    }

    protected function getNPSN(string $string)
    {
        $explode = explode(',', $string);
        return trim(preg_replace('/[^\d]+/i','',$explode[1]));
    }

    protected function getUniv(string $string)
    {
        $explode = explode(',', $string);
        return trim($explode[0]);
    }
}
