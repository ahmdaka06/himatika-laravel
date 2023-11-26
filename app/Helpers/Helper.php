<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('user')):
    function user(): Object|Bool{
        if (Auth::check()) return Auth::user();
        else return false;
    }
endif;

if (!function_exists('admin')):
    function admin(): Object|Bool{
        if (Auth::guard('admin')->check()) return Auth::guard('admin')->user();
        else return false;
    }
endif;

if (!function_exists('getConfig')):
    function getConfig(String $key){
        $row = DB::table('website_configs')->select('value')->where('key', $key)->first();
        if (is_null($row)) {
            return null;
        } else {
            return json_decode($row->value);
        }
        return null;
    }
endif;

if (!function_exists('setConfig')):
    function setConfig(String $key, $value = null){
        $row = DB::table('website_configs')->select('value')->where('key', $key)->first();
        if (is_null($row) OR $row == false) {
            return DB::table('website_configs')->insert(['key' => $key, 'value' => $value]);
        } else {
            return DB::table('website_configs')->where('key', $key)->update(['value' => $value]);
        }
        return false;
    }
endif;

if (!function_exists('convertString')):
    function convertString(String $string = null, String $convertTo = null){
        $convert = strtr($string, [
            '{{ WEBSITE_TITLE }}' => getConfig('title'),
            '{{ PRICE }}' => '<b>Rp ' . currency($convertTo) . '</b>',
            '{{ YEAR }}' => date('Y'),
        ]);
        return $convert;
    }
endif;

if (!function_exists('currency')) {
    function currency($value = null): String{
      $currency = number_format($value, 0, ".", ".");
      return (string) $currency;
    }
}

if (!function_exists('generate_api_key')):
    function generate_api_key(): String {
        return implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
    }
endif;

if (!function_exists('sum_date')):
    function sum_date(String $date = '', $parameter = null) {
        return date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($date)).$parameter));
    }
endif;

if (!function_exists('diff_date')):
    function diff_date($date_a = '', $date_b = '') {
        $date_a = \Carbon\Carbon::parse(date_create($date_a));
        $date_b = \Carbon\Carbon::parse(date_create($date_b));
        $diff = date_diff($date_a, $date_b);
        return $diff->format("%R%a");
    }
endif;

if (!function_exists('list_date_range')):
    function list_date_range(String $start, String $end, String $format = 'Y-m-d'): Array {
        $start = \Carbon\Carbon::parse($start);
        $end = \Carbon\Carbon::parse($end);
        $end = new DateTime($end);
        $end = $end->add(new DateInterval('P1D'))->format('Y-m-d');

        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        $date_list = [];
        foreach ($period as $key => $value) {
            $date_list[] = $value->format($format);
        }
        return $date_list;
    }
endif;

if (!function_exists('format_datetime')):
    function format_datetime(String $i = null): String {
        if (is_null($i)) return $i;
        $i = \Carbon\Carbon::parse($i);
        $month = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $split = explode(" ", $i);
        $date = explode("-", $split[0]);
        $format_date = $date[2].' '.$month[$date[1]].' '.$date[0];
        return $format_date.', '.$split[1];
    }
endif;

if (!function_exists('format_date')):
    function format_date(String $i = null): String {
        if (is_null($i)) return $i;
        \Carbon\Carbon::parse($i);
        $month = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $split = explode(" ", $i);
        $date = explode("-", $split[0]);
        $format_date = $date[2].' '.$month[$date[1]].' '.$date[0];
        return $format_date;
    }
endif;

if (!function_exists('makeValidator')):
    function makeValidator(array $data, array $rules, array $messages = [], array $customAttributes = []) {
        return \Illuminate\Support\Facades\Validator::make($data, $rules, $messages, $customAttributes);
    }
endif;

if (!function_exists('makeSlug')):
    function makeSlug($title, $separator = '-', $language = 'en'): String{
        return Illuminate\Support\Str::slug(strtolower($title), $separator, $language);
    }
endif;

if (!function_exists('parseCarbon')):
    function parseCarbon($date = ''){
        return \Carbon\Carbon::parse($date);
    }
endif;

if (!function_exists('convertPercent')):
    function convertPercent($value): Float{
      return $value / 100;
    }
endif;

if (!function_exists('getSiteMap')):
    function getSiteMap(): Object{
        return DB::table('pages')
            ->select('slug', 'title')
            ->orderBy('id', 'ASC')
            ->get();
    }
endif;

if (!function_exists('getPopularCategory')):
    function getPopularCategory(): Object{
        return DB::table('service_categories')
            ->select('service_type', 'slug', 'name', 'img')
            ->orderBy('counter', 'DESC')
            ->limit(6)
            ->get();
    }
endif;

if (!function_exists('isXMLRequest')):
    function isXMLRequest(): Bool{
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')  return true;
        return false;
    }
endif;

if(!function_exists('onlineHours')):
    function onlineHours($start, $stop, $format = 'Hi'):Bool {
        if($start == $stop) return true;
        if(date($format) >= preg_replace('/\D/', '', $start) && date($format) <= preg_replace('/\D/', '', $stop)) return true;
        return false;
    }
endif;

if(!function_exists('getServicePriceByLevel')):
    function getServicePriceByLevel($value) {
        $getPrice = $value->price;
        $getLevel =  Auth::check() == true ? Auth::user()->level : 'public';
        return $value->price->{$getLevel};
    }
endif;

if(!function_exists('setResponse')):
    function setResponse(Bool $status, String $msg):Array {
        return [
            'status' => $status,
            'msg' => $msg
        ];
        exit;
    }
endif;

if(!function_exists('qrImage')):
    function qrImage($val, $ize = 512) {
        if($val == '') return 'https://dummyimage.com/512x512/ffffff/ffffff.png';
        $val = urlencode($val); $ize = $ize.'x'.$ize;
        return "https://chart.googleapis.com/chart?chs=$ize&cht=qr&chl=$val";
    }
endif;

if(!function_exists('arrayToString')):
    function arrayToString(array $arr, string $keys) {
        $string = '';
        foreach ($arr as $key => $value) {
            $string .= $value[$keys] . ',';
        }
        return rtrim($string, ',');
    }
endif;

if(!function_exists('arrayValueSearch')):
    function arrayValueSearch(array $arr, string $keys, string $search) {
        foreach ($arr as $k => $v) {
            if ($v[$keys] == $search) return $v;
        }
    }
endif;

