@extends('layouts.user.app')
@section('title')
{{ $page['title'] }}
@endsection

@section('content')
<div class="row ">
    <div class="col-lg-6 col-md-12 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-start">
                <h5 class="fw-bold"><i class="mdi mdi-account-multiple"></i> <span>Total peserta</span></h5>
            </div>

            <h3 class="card-title text-nowrap mb-1 text-end">{{ currency($participants['total']) }} </h3>
          </div>
        </div>
    </div>
</div>
@endsection
