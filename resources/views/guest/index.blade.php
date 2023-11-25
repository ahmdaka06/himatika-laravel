@extends('layouts.guest.app')
@section('title')
{{ $page['title'] }}
@endsection

@section('content')
<div class="row ">
    <div class="col-md-4 col-lg-4 mb-3">
        <div class="card h-100">
            <img class="card-img-top" src="{{ url('images/cooming-soon-story.jpg') }}" alt="Card image cap" />
        </div>
    </div>
    <div class="col-md-8 col-lg-8 mb-3">
        <div class="card">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title  text-white fs-bold my-auto"><i class="tf-icons mdi mdi-bullhorn-outline"></i>
                    Seminar</h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">
                    With supporting text below as a natural lead-in to additional content natural lead-in to
                    additional content.
                </p>
                <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
@endsection
