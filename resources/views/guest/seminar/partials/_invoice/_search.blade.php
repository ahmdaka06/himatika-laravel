<div class="row justify-content-center d-none-print">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title text-white fs-bold my-auto"><i class="tf-icons bx bx-search"></i> Cari Faktur</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="invoice-form" action="{{ route('guest.seminar.invoicePOST') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nomor Faktur</label>
                            <input type="text" class="form-control" name="invoice" id="invoice" placeholder="#INV-3243902" value="{{ request()->segment(3) ?? old('invoice') }}">
                            <small class="text-danger invoice-invalid"></small>
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
    function reset_button(value = 0) {
        if (value == 0) {
            $('button[type="submit"]').attr('disabled', 'true');
            $('button[type="submit"]').text('');
            $('button[type="submit"]').append(
                '<span class=\"spinner-grow spinner-grow-sm\" role=\"status\" aria-hidden=\"true\"></span>Mohon Tunggu...'
            );
        } else {
            $('button[type="submit"]').removeAttr('disabled');
            $('button[type="submit"]').removeAttr('span');
            $('button[type="submit"]').html('<i class="mdi mdi-check mx-2"></i> Submit');
        }
    }
    $(function () {
        $("#invoice-form").on('submit', function (e) {
            e.preventDefault();
            console.log(this);
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    reset_button(0);
                    $(document).find('small.text-danger').text('');
                    $(document).find('input').removeClass('is-invalid');
                    swal.fire({
                        title: 'Mohon Tunggu...',
                        allowOutsideClick: false,
                        didOpen: function () {
                            swal.showLoading()
                        }
                    })
                },
                success: function (data) {
                    reset_button(1);
                    if (data.status == false) {
                        if (data.type == 'validation') {
                            swal.close();
                            $.each(data.msg, function (key, val) {
                                $("input[name=" + key + "]").addClass('is-invalid');
                                $('small.' + key + '-invalid').text(val[0]);
                            });
                        }
                        if (data.type == 'alert') {
                            swal.fire("Gagal!", data.msg, "error");
                        }
                    } else {
                        $('#invoice-form')[0].reset();
                        swal.fire("Berhasil!", data.msg, "success").then(function () {
                            window.location = data.redirect_url;
                        });
                    }
                },
                error: function () {
                    reset_button(1);
                    swal.fire("Gagal!", "Terjadi kesalahan.", "error");
                },
            });
        });
    });

</script>
@endpush
