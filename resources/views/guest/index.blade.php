@extends('layouts.guest.app')
@section('title')
{{ $page['title'] }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-lg-4 mb-3">
        <div class="card">
            <img class="card-img-top" src="{{ ((isset(getConfig('primary')->pamflet_primary) AND getConfig('primary')->pamflet_primary <> '') ? url('storage/pamflet/'. getConfig('primary')->pamflet_primary) : null) }}" alt="Pamflet Seminar Himatika" />
            <div class="card-body">
                <div class="text-center">
                    <h5>Mau daftar jadi peserta seminar ??</h5>
                    <a href="{{ route('guest.seminar.registerGET') }}" class="btn btn-primary"> Klik Disini</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-lg-8 mb-3">
        <div class="card overflow-hidden mb-4" style="height: 500px">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title  text-white fs-bold my-auto"><i class="tf-icons mdi mdi-bullhorn-outline"></i> Informasi </h5>
            </div>
            <div class="card-body" id="vertical-example">
                @forelse ($news as $key => $value)
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-white fs-bold my-auto"> {{ $value->title }} </h6>
                        <small class="float-end"><i class="bx bx-calendar"></i> {{ format_datetime($value->created_at) }} </small>
                        <br>
                        <hr>
                        {!! $value->content !!}
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-12 mb-3">
        <div class="divider">
            <div class="divider-text">
                <h5 class="mt-2">Sponsor</h5>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <img src="{{ url('storage/logo/logo-vip.png') }}" height="250px" width="250px" alt="">
            </div>
            <div class="col-md-4">
                <img src="{{ url('storage/logo/logo-dolanankode.png') }}" height="250px" width="250px" alt="">
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    const verticalExample = document.getElementById('vertical-example');
    // Vertical Example
    // --------------------------------------------------------------------
    if (verticalExample) {
      new PerfectScrollbar(verticalExample, {
        wheelPropagation: false
      });
    }

  })();
});
</script>
@endpush
@endsection
