@extends('layouts.guest.app')
@section('title')
{{ $page['title'] }}
@endsection
@section('styles')
<style>
    .divider {
        margin: 0 !important;
    }

    h5.strip:after,
    h5.strip:before {
        height: 4px;
        display: inline-block;
        content: ' ';
        position: absolute;
        margin-top: 38px;
        border-radius: 100px;
        background: var(--bs-primary);
    }

    h5.strip:before {
        width: 50px;
    }

    @media print {
        .text-primary {
            color: #000 !important;
        }
        .btn {
            background-color: #FFF !important;
            color: #000 !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important
            margin: 0 !important;
            /* display: inline-flex; */
            align-items: right !important;
            justify-content: right !important;
            text-align: right !important;
            vertical-align: right !important;
        }
        body {
            padding: 0;
            margin: 0;
        }

        .d-none-print {
            display: none;
        }

        * {
            color: #000 !important;
        }

        .card-print {
            max-width: 450px;
            margin: auto;
        }

        .card-print .card-title {
            text-align: center;
        }

        .content-main {
            padding-top: 0;
        }
    }

</style>
@endsection
@section('content')
@if (isset($invoice))
    @include('guest.seminar.partials._invoice._search')
    @include('guest.seminar.partials._invoice._index')
@else
    @include('guest.seminar.partials._invoice._search')
@endif
@endsection
