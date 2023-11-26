<form method="POST" id="upload-proof" action="{{ request()->url() }}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row">
        <div class="form-group col-md-12 my-1">
            <label for="">Bukti Transfer  </label>
            <input type="file" class="dropify" name="pay_proof" id="pay_proof" value="{{ old('pay_proof') }}" placeholder="Bukti Pembayaran">
            <small class="text-danger pay_proof-invalid"></small>
        </div>
        <div class="form group col-md-12 d-flex justify-content-center my-3">
            <button type="submit" class="btn btn-primary"><i class="mdi mdi-check mx-2"></i> Submit</button>
        </div>
    </div>
</form>
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
        $('#upload-proof').on('submit', function(e) {
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
                        $('#upload-proof')[0].reset();
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
