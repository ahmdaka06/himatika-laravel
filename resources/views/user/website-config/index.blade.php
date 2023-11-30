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
                <form method="POST" id="website-config-form" action="{{ request()->url() }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="form-group">
                            <label for="name">Pamflet Utama</label>
                            <input 
                                type="file" 
                                class="dropify"
                                name="pamflet_primary" 
                                id="pamflet_primary" 
                                value="{{ ((isset(getConfig('primary')->pamflet_primary) AND getConfig('primary')->pamflet_primary <> '') ? url('storage/pamflet/'. getConfig('primary')->pamflet_primary) : null) }}" placeholder="Bukti Pembayaran"
                                data-default-file="{{ ((isset(getConfig('primary')->pamflet_primary) AND getConfig('primary')->pamflet_primary <> '') ? url('storage/pamflet/'. getConfig('primary')->pamflet_primary) : '...') }}"
                                value="{{ ((isset(getConfig('primary')->pamflet_primary) AND getConfig('primary')->pamflet_primary <> '') ? url('storage/pamflet/'. getConfig('primary')->pamflet_primary) : null) }}"
                            >
                            <small class="text-danger pamflet_primary-invalid"></small>
                        </div>
                        <div class="form-group">
                            <label for="started_at">Pendaftaran Di Buka</label>
                            <input type="datetime-local" class="form-control" name="started_at" id="started_at" value="{{ parseCarbon(getConfig('primary')->started_at ?? '') }}">
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

    });
</script>
<script>
    $(document).ready(function () {
        $('#website-config-form').on('submit', function(e) {
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
                        $('#website-config-form')[0].reset();
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
