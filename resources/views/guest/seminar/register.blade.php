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
<div class="row justify-content-center">
    @if (now()->isAfter(parseCarbon('2024-12-12')))
    <div class="col-md-12">
        <h5 class="text-center"> Registrasi peserta sudah di tutup</h5>
    </div>
    @elseif (now()->isAfter(parseCarbon(getConfig('primary')->started_at)))
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
                            <label for="">Nama Lengkap <em class="text-danger ms-2"> *harus sesuai dengan KTM</em></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Nama lengkap">
                            <small class="text-danger name-invalid"></small>
                        </div>
                        {{-- <div class="form-group col-md-12 my-1">
                            <label for="">Asal Institusi </label>
                            <input type="text" class="form-control" name="institutional_origin" id="institutional_origin" value="{{ old('institutional_origin') }}" placeholder="Asal Institusi">
                            <small class="text-danger institutional_origin-invalid"></small>
                        </div> --}}
                        <div class="form-group col-md-12 my-1">
                            <label for="">Asal Institusi / Universitas </label>
                            {{-- <select name="institutional_origin" id="institutional_origin" class="form-select select2"></select> --}}
                            {{-- <input type="text" class="form-control" name="institutional_origin" id="institutional_origin" value="{{ old('institutional_origin') }}" placeholder="Asal Institusi"> --}}
                            <select class="form-select" name="institutional_origin" id="institutional_origin">
                                <option value="">Pilih salah satu</option>
                                @foreach (config('constants.universities') as $key => $value)
                                    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger institutional_origin-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1 d-none" id="form-institutional">
                            <label for="">Nama Instansi / Universitas </label>
                            <input type="text" class="form-control" name="institutional_name" id="institutional_name" value="{{ old('institutional_name') }}" placeholder="Contoh: STIKIP PGRI JOMBANG, STIKES, UNWAHA dsb">
                            <small class="text-danger institutional_name-invalid"></small>
                        </div>
                        <div class="divider">
                            <div class="divider-text">
                                <h5 class="mt-2">Pembayaran</h5>
                            </div>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Pembayaran</label>
                            <select class="form-select" name="payment" id="payment">
                                <option value="">Pilih salah satu</option>
                                @foreach (config('constants.payments') as $key => $value)

                                    <option value="{{ $value['name'] }}">{{  $value['name'] . ' ' . $value['account'] . ' - ' . $value['holder'] . ' - ' . ($value['is_manual'] == true ? 'Konfirmasi Manual' : 'Otomatis') }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="pay_sender" id="pay_sender" value="{{ old('pay_sender') }}" placeholder="Contoh: BRI 3171xxx, DANA 081xxx"> --}}
                            <small class="text-danger payment-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Atas Nama Pengirim </label>
                            <input type="text" class="form-control" name="pay_sender" id="pay_sender" value="{{ old('pay_sender') }}" placeholder="Contoh: BRI 3171xxx, DANA 081xxx">
                            <small class="text-danger pay_sender-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Bukti Transfer <em class="text-danger">*Kosongkan jika belum melakukan transfer</em></label>
                            <input type="file" class="dropify" name="pay_proof" id="pay_proof" value="{{ old('pay_proof') }}" placeholder="Bukti Pembayaran">
                            <small class="text-danger pay_proof-invalid"></small>
                        </div>
                        <div class="divider">
                            <div class="divider-text">
                                <h5 class="mt-2">Lainnya</h5>
                            </div>
                        </div>
                        {{-- <div class="form-group col-md-12 my-1">
                            <label for="">Bukti Follow Sosial Media </label>
                            <input type="file" class="form-control" name="follow_prof" id="follow_prof" value="{{ old('follow_prof') }}" placeholder="Asal Institusi">
                            <small class="text-danger follow_prof-invalid"></small>
                        </div> --}}
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
                        <div class="form-group col-md-12 my-1">
                            <label for="">Mengikuti Secara ?</label>
                            <select class="form-select" name="attend" id="attend">
                                <option value="">Pilih salah satu</option>
                                @foreach (config('constants.attendances.types') as $key => $value)
                                    @if ($key == 'offline')
                                        @continue
                                    @endif
                                    <option value="{{ $key }}">{{  $value }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="pay_sender" id="pay_sender" value="{{ old('pay_sender') }}" placeholder="Contoh: BRI 3171xxx, DANA 081xxx"> --}}
                            <small class="text-danger attend-invalid"></small>
                        </div>
                        <div class="form group col-md-12 d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-primary"><i class="mdi mdi-check mx-2"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
        <div class="col-md-12">
            <h5 class="text-center"> Registrasi Peserta Akan Di Buka Pada {{ format_datetime(getConfig('primary')->started_at) }}</h5>
            <H1 class="text-center mt-5" id="demo"></H1>
        </div>
    @endif
</div>

@push('scripts')
@if (now()->isAfter(parseCarbon(getConfig('primary')->started_at)) == false)
<script>
    // Set the date we're counting down to
    // 1. JavaScript
    // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
    // 2. PHP
    var countDownDate = {{ strtotime(getConfig('primary')->started_at) }} * 1000;
    var now = {{ time() }} * 1000;

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        // 1. JavaScript
        // var now = new Date().getTime();
        // 2. PHP
        now = now + 1000;

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "REGISTRASI PESERTA SUDAH DI BUKA !!";
            setInterval(function () {
                window.location = '{{ request()->url() }}';
            }, 1000);
        }
    }, 1000);
</script>
@endif
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
    $(document).ready(function () {
        $('select[name="institutional_origin"]').change(function (e) {
            e.preventDefault();
            console.log($('select[name="institutional_origin"] option:selected').val());
            if ($('select[name="institutional_origin"] option:selected').val() == '2') {
                $('#form-institutional').removeClass('d-none');
            } else {
                $('#form-institutional').addClass('d-none');
            }
        });
        $('.select2').select2({
            placeholder: 'Pilih Institusi',
            minimumInputLength: 2,
            // ajax: {
            //     url: '{{ route('universitas.searchGET') }}?__m=__searchInstitutional',
            //     dataType: 'json',
            //     delay: 500,
            //     processResults: function (data) {
            //         return {
            //             results: data
            //         };
            //     },
            //     cache: true
            // }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#register-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    reset_button(0, 'button[type="submit"]');
                    $(document).find('small.text-danger').text('');
                    $(document).find('input').removeClass('is-invalid');
                    $(document).find('select').removeClass('is-invalid');
                    swal.fire({
                        title: 'Harap menunggu...',
                        allowOutsideClick: false,
                        didOpen: function () {
                            swal.showLoading()
                        }
                    })
                },
                success: function (data) {
                    reset_button(1, 'button[type="submit"]');
                    if (data.status == false) {
                        if (data.type == 'validation') {
                            swal.close();
                            $.each(data.msg, function (key, val) {
                                $('input[name=' + key.replaceAll(".", "_") + ']').addClass('is-invalid');
                                $('select[name=' + key.replaceAll(".", "_") + ']').addClass('is-invalid');
                                $('select[name=' + key.replaceAll(".", "_") + ']').focus();
                                // $("option").addClass('is-invalid').focus();
                                $('textarea[name=' + key.replaceAll(".", "_") + ']').addClass('is-invalid');
                                $('textarea[name=' + key.replaceAll(".", "_") + ']').addClass('is-invalid').focus();
                                $('small.' + key.replaceAll(".", "_") + '-invalid').text(val[0]);
                            });
                        }
                        if (data.type == 'alert') {
                            swal.fire('Gagal!', data.msg, 'error');
                        }
                    } else {
                        $('#register-form')[0].reset();
                        swal.fire('Success!', data.msg, 'success');
                        setInterval(function () {
                            window.location = data.redirect_url;
                        }, 1000);
                    }
                },
                error: function () {
                    reset_button(1, button);
                    swal.fire("Fails!", "Terjadi kesalahan pada sistem!..", "error");
                },
            });
        });
    });
</script>
@endpush
@endsection
