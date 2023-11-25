@extends('layouts.guest.app')
@section('title')
{{ $page['title'] }}
@endsection
@section('styles')
<style>
.divider {
    margin: 0!important;
}

</style>
@endsection
@section('content')
<div class="row ">
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title  text-white fs-bold my-auto"><i class="tf-icons mdi mdi-bullhorn-outline"></i> Informasi !</h5>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-md-8 mb-4">
        <div class="card mb-4">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title  text-white fs-bold my-auto"><i class="tf-icons bx bx-credit-card-alt"></i> Pendaftaran Seminar</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="register-form" action="{{ route('guest.seminar.registerPOST') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="divider">
                            <div class="divider-text">
                                <h5 class="mt-2">Data Diri</h5>
                            </div>
                        </div>
                        <div class="form-group col-md-6 my-1">
                            <label for="">Email <em class="text-danger ms-2"> *harus aktif</em></label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
                            <small class="text-danger email-invalid"></small>
                        </div>
                        <div class="form-group col-md-6 my-1">
                            <label for="">Nama Lengkap </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Nama Lengkap">
                            <small class="text-danger name-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Asal Institusi </label>
                            <input type="text" class="form-control" name="institutional_origin" id="institutional_origin" value="{{ old('institutional_origin') }}" placeholder="Asal Institusi">
                            <small class="text-danger institutional_origin-invalid"></small>
                        </div>
                        <div class="divider">
                            <div class="divider-text">
                                <h5 class="mt-2">Pembayaran</h5>
                            </div>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Atas Nama Pengirim dan Pembayaran</label>
                            <input type="text" class="form-control" name="pay_sender" id="pay_sender" value="{{ old('pay_sender') }}" placeholder="Contoh: BRI 3171xxx, DANA 081xxx">
                            <small class="text-danger pay_sender-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Bukti Transfer </label>
                            <input type="file" class="dropify" name="pay_proof" id="pay_proof" value="{{ old('pay_proof') }}" placeholder="Bukti Pembayaran">
                            <small class="text-danger pay_proof-invalid"></small>
                        </div>
                        <div class="divider">
                            <div class="divider-text">
                                <h5 class="mt-2">Lainnya</h5>
                            </div>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Bukti Follow Sosial Media </label>
                            <input type="file" class="form-control" name="follow_prof" id="follow_prof" value="{{ old('follow_prof') }}" placeholder="Asal Institusi">
                            <small class="text-danger follow_prof-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nomor Whatsapp </label>
                            <input type="number" class="form-control" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" placeholder="Contoh: 62814xxxxxxx">
                            <small class="text-danger whatsapp-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Rekomendasi dari </label>
                            <input type="text" class="form-control" name="recom_by" id="recom_by" value="{{ old('recom_by') }}" placeholder="Contoh: @himatika.undar, @mukhshlxxxx, Muhammad Abdullah">
                            <small class="text-danger recom_by-invalid"></small>
                        </div>
                        <div class="form group col-md-12 d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-primary"><i class="mdi mdi-check mx-2"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
</script>
<script>
    requestSubmit('#register-form', '#register-form', 'button[type="submit"]', 'redirect', '{{ route('guest.seminar.registerGET') }}');
</script>
@endpush
@endsection
