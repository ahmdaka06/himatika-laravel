@extends('layouts.user.app')
@section('title')
{{ $page['title'] }}
@endsection

@section('content')
<div class="row ">
    <div class="col-lg-12 col-md-12 col-12 mb-4">
        <div class="card">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title  text-white fs-bold my-auto"><i class="tf-icons mdi mdi-fire"></i> Top Rekomendasi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap mb-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Rekomendasi</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants['data'] as $participant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $participant->recom_by }}</td>
                                <td>{{ $participant->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
