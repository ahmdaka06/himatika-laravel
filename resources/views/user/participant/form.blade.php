@extends('layouts.user.app')
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
    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title  text-white fs-bold my-auto"><i class="tf-icons bx bx-credit-card-alt"></i> Pendaftaran Seminar</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="register-form" action="{{ request()->url() }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nomor Invoice <em class="text-danger"> *Generate otomatis by system</em></label>
                            <input type="text" class="form-control" value="{{ $participant->invoice ?? 'INV-xxxxx' }}" readonly>
                            <small class="text-danger recom_by-invalid"></small>
                        </div>
                        <div class="divider">
                            <div class="divider-text">
                                <h5 class="mt-2">Data Diri</h5>
                            </div>
                        </div>
                        <div class="form-group col-md-6 my-1">
                            <label for="">Email <em class="text-danger ms-2"> *harus aktif</em></label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ $participant->email ?? old('email') }}" placeholder="Email">
                            <small class="text-danger email-invalid"></small>
                        </div>
                        <div class="form-group col-md-6 my-1">
                            <label for="">Nama Lengkap <em class="text-danger ms-2"> *harus sesuai dengan KTM</em></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $participant->name ?? old('name') }}" placeholder="Nama lengkap">
                            <small class="text-danger name-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Asal Institusi / Universitas </label>
                            <select class="form-select" name="institutional_origin" id="institutional_origin">
                                <option value="">Pilih salah satu</option>
                                @foreach (config('constants.universities') as $key => $value)
                                    <option value="{{ $value['id'] }}" @if (isset($participant->institutional_origin['npsn']) AND $participant->institutional_origin['npsn'] == $value['id']) selected @endif >{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger institutional_origin-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1 {{ (isset($participant->institutional_origin['npsn']) AND $participant->institutional_origin['npsn'] == '2') ? '' : 'd-none' }}" id="form-institutional">
                            <label for="">Nama Instansi / Universitas </label>
                            <input type="text" class="form-control" name="institutional_name" id="institutional_name" value="{{ (isset($participant->institutional_origin['npsn']) AND $participant->institutional_origin['npsn'] == '2') ? $participant->institutional_origin['name'] : old('institutional_name') }}" placeholder="Contoh: STIKIP PGRI JOMBANG, STIKES, UNWAHA dsb">
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
                                    <option value="{{ $value['name'] }}" @if (isset($participant->payment['name']) AND $participant->payment['name'] == $value['name']) selected @endif>{{  $value['name'] . ' ' . $value['account'] . ' - ' . $value['holder'] . ' - ' . ($value['is_manual'] == true ? 'Konfirmasi Manual' : 'Otomatis') }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger payment-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Atas Nama Pengirim </label>
                            <input type="text" class="form-control" name="pay_sender" id="pay_sender" value="{{ $participant->pay_sender ?? old('pay_sender') }}" placeholder="Contoh: BRI 3171xxx, DANA 081xxx">
                            <small class="text-danger pay_sender-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Bukti Transfer <em class="text-danger">*Kosongkan jika belum melakukan transfer</em></label>
                            <input type="file" class="dropify" name="pay_proof" id="pay_proof" value="{{ old('pay_proof') }}" placeholder="Bukti Pembayaran"
                                data-default-file="{{ ($participant->pay_proof ? url('storage/seminar/pay_proof/'. $participant->pay_proof) : null) }}"
                                value="{{ ($participant->pay_proof ? url('storage/seminar/pay_proof/'. $participant->pay_proof) : null) }}"
                                >
                            <small class="text-danger pay_proof-invalid"></small>
                        </div>
                        <div class="divider">
                            <div class="divider-text">
                                <h5 class="mt-2">Lainnya</h5>
                            </div>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nomor Whatsapp </label>
                            <input type="number" class="form-control" name="whatsapp" id="whatsapp" value="{{ $participant->whatsapp ?? old('whatsapp') }}" placeholder="Contoh: 62814xxxxxxx">
                            <small class="text-danger whatsapp-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Rekomendasi dari </label>
                            <input type="text" class="form-control" name="recom_by" id="recom_by" value="{{ $participant->recom_by ?? old('recom_by') }}" placeholder="Contoh: @himatika.undar, @mukhshlxxxx, Muhammad Abdullah">
                            <small class="text-danger recom_by-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Mengikuti Secara ?</label>
                            <select class="form-select" name="attend" id="attend">
                                <option value="">Pilih salah satu</option>
                                @foreach (config('constants.attendances.types') as $key => $value)
                                    <option value="{{ $key }}"  @if($participant->attend == $key) selected @endif>{{  $value }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="pay_sender" id="pay_sender" value="{{ old('pay_sender') }}" placeholder="Contoh: BRI 3171xxx, DANA 081xxx"> --}}
                            <small class="text-danger attend-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Harga </label>
                            <input type="number" class="form-control" value="{{ $participant->price ?? '15000' }}" name="price" readonly>
                            <small class="text-danger price-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Sudah Di bayar ?</label>
                            <select class="form-select" name="is_paid" id="is_paid">
                                <option value="">Pilih salah satu</option>
                                <option value="0" @if($participant->is_paid == '0') selected @endif>Belum</option>
                                <option value="1" @if($participant->is_paid == '1') selected @endif>Sudah</option>
                            </select>
                            {{-- <input type="text" class="form-control" name="pay_sender" id="pay_sender" value="{{ old('pay_sender') }}" placeholder="Contoh: BRI 3171xxx, DANA 081xxx"> --}}
                            <small class="text-danger is_paid-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="">Pilih salah satu</option>
                                @foreach (config('constants.statuses') as $key => $value)
                                    <option value="{{ $value['key'] }}" @if($participant->status == $value['key']) selected @endif>{{  $value['name'] }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="pay_sender" id="pay_sender" value="{{ old('pay_sender') }}" placeholder="Contoh: BRI 3171xxx, DANA 081xxx"> --}}
                            <small class="text-danger status-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Alasan di tolak </label>
                            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control">{{ $participant->reason ?? old('reason') }}</textarea>
                            <small class="text-danger reason-invalid"></small>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Sertifikat</label>
                            <input type="file" class="dropify" name="certificate" id="certificate"
                                data-default-file="{{ ($participant->certificate ? url('storage/seminar/sertif/'. $participant->certificate) : null) }}"
                                value="{{ ($participant->certificate ? url('storage/seminar/sertif/'. $participant->certificate) : null) }}"
                                placeholder="Sertifikat">
                            <small class="text-danger certificate-invalid"></small>
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
    $(document).ready(function () {
        $('select[name="institutional_origin"]').change(function (e) {
            e.preventDefault();
            if ($('select[name="institutional_origin"] option:selected').val() == '2') {
                $('#form-institutional').removeClass('d-none');
            } else {
                $('#form-institutional').addClass('d-none');

            }
            if ($('select[name="institutional_origin"] option:selected').val() != '071023') {
                $('input[name=price]').val('15000');
            } else {
                $('#form-institutional').addClass('d-none');
                $('input[name=price]').val('10000');
            }
        });
        $('select[name="is_paid"]').change(function (e) {
            e.preventDefault();
            var is_paid = $('select[name="is_paid"] option:selected').val();
            if (is_paid == '1') {
                $('select[name="status"]').val('approved').change();
            } else {
                $('select[name="status"]').val('pending').change();

            }
        });
        // $('select[name="status"]').change(function (e) {
        //     e.preventDefault();
        //     var status = $('select[name="status"] option:selected').val();
        //     if (status == 'approved' || status == 'success') {
        //         $('select[name="is_paid"]').val('1').change();
        //     } else {
        //         $('select[name="is_paid"]').val('0').change();

        //     }
        // });
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
