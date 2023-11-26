function copy(id) {
    var copyText = document.getElementById(id);
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    document.execCommand("copy");
    swal.fire("Disalin!", "'" + copyText.value + "'.", "success");
}
function reset_button(value = 0, button = 'button[type="submit"]') {
    if (value == 0) {
        $(button).attr('disabled', 'true');
        $(button).text('');
        $(button).append(
            '<span class=\"spinner-grow spinner-grow-sm\" role=\"status\" aria-hidden=\"true\"></span>Mohon Tunggu...'
        );
        $('button[type="reset"]').hide();
    } else {
        $(button).removeAttr('disabled');
        $(button).removeAttr('span');
        $(button).html('<i class="mdi mdi-check mx-2"></i>Submit');
        $('button[type="reset"]').show();
    }
}
function requestSubmit(modal = '#modal-form', element = '', button = 'button[type="submit"]', type = 'default', redirect = '') {
    $(element).on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                reset_button(0, button);
                $(document).find('small.text-danger').text('');
                $(document).find('input').removeClass('is-invalid');
                swal.fire({
                    title: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: function () {
                        swal.showLoading()
                    }
                })
            },
            success: function (data) {
                reset_button(1, button);
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
                    $(element)[0].reset();
                    if (type === 'default') {
                        $(modal).modal('hide');
                        swal.fire('Success!', data.msg, 'success');
                    }
                    if (type === 'datatables') {
                        $(modal).modal('hide');
                        swal.fire('Success!', data.msg, 'success');
                        $('#datatable').DataTable().ajax.reload();
                    }
                    if (type === 'redirect') {
                        swal.fire('Success!', data.msg, 'success');
                        setInterval(function () {
                            window.location = redirect;
                        }, 1000);
                    }
                    if (type === 'r_redirect') {
                        swal.fire('Success!', data.msg, 'success');
                        setInterval(function () {
                            window.location = data.redirect_url;
                        }, 1000);
                    }
                }
            },
            error: function () {
                reset_button(1, button);
                swal.fire("Fails!", "Terjadi kesalahan pada sistem!..", "error");
            },
        });
    });
}
$(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    if($('.summernote').length > 0) {
        $('.summernote').summernote({
            height: 320,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    }
    if($('.droptify'),length > 0) {
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    }
});
function selectSearch(element, url) {
    $(element).select2({
        dropdownParent: $('.modal'),
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: false
        }
    });
}

function reset_button_modal(value = 0) {
    if (value == 0) {
        $('button[name="button_form_modal"]').attr('disabled', 'true');
        $('button[name="button_form_modal"]').text('');
        $('button[name="button_form_modal"]').append('<span class=\"spinner-grow spinner-grow-sm mb-1\"></span> Mohon tunggu...');
        $('button[type="reset"]').hide();
    } else {
        $('button[name="button_form_modal"]').removeAttr('disabled');
        $('button[name="button_form_modal"]').removeAttr('span');
        $('button[name="button_form_modal"]').text('');
        $('button[name="button_form_modal"]').append('<i class=\"fa fa-check\"></i> Submit');
        $('button[type="reset"]').show();
    }
}
$(function () {
    requestSubmit('#modal-form', '#main-form-modal', 'button[name="button_form_modal"]', 'datatables', '');
    // $("#main-form-modal").on('submit', function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: $(this).attr('action'),
    //         method: $(this).attr('method'),
    //         data: new FormData(this),
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         beforeSend: function() {
    //             reset_button_modal(0);
    //             swal.fire({
    //                 title: 'Mohon tunggu...',
    //                 allowOutsideClick: false,
    //                 didOpen: function () {
    //                   swal.showLoading()
    //                 }
    //             })
    //             $(document).find('small.text-danger').text('');
    //             $(document).find('input').removeClass('is-invalid');
    //             $(document).find('select').removeClass('is-invalid');
    //             $(document).find('textarea').removeClass('is-invalid');
    //         },
    //         success: function(data) {
    //             swal.close()
    //             reset_button_modal(1);
    //             if (data.status == false) {
    //                 if (data.type == 'validation') {
    //                     $.each(data.msg, function(key, val) {
    //                         $("input[name=" + key.replace(".", "_") + "]").addClass('is-invalid').focus();
    //                         $("select[name=" + key.replace(".", "_") + "]").focus();
    //                         // $("option").addClass('is-invalid').focus();
    //                         $("textarea[name=" + key.replace(".", "_") + "]").addClass('is-invalid').focus();
    //                         $('small.' + key.replace(".", "_") +'-invalid').text(val[0]).focus();
    //                     });
    //                 }
    //                 if (data.type == 'alert') {
    //                     swal.fire("Gagal!", data.msg, "error");
    //                 }
    //             } else {
    //                 reset_button_modal(1);
    //                 $("#modal-form").modal('hide');
    //                 Toast.fire("Berhasil!", data.msg, "success");
    //                 $('#datatable').DataTable().draw();
    //             }
    //         },
    //         error: function() {
    //             swal.close()
    //             reset_button_modal(1);
    //             $(document).find('small.text-danger').text('');
    //             $(document).find('input').removeClass('is-invalid');
    //             $(document).find('select').removeClass('is-invalid');
    //             $(document).find('textarea').removeClass('is-invalid');
    //             swal.fire("Gagal!", "Terjadi kesalahan.", "error");
    //         },
    //     });
    // });
});

function modal(type, title = 'Data', url) {
    if (type == 'add') {
        $('#modal-title').html('<i class="fa fa-plus-square"></i> Tambah ' + title);
    } else if (type == 'send') {
        $('#modal-title').html('<i class="fa fa-plus-square"></i> Kirim ' + title);
    } else if (type == 'edit') {
        $('#modal-title').html('<i class="fa fa-edit"></i> Edit ' + title);
    } else if (type == 'reply') {
        $('#modal-title').html('<i class="fa fa-edit"></i> Balas ' + title);
    } else if (type == 'delete') {
        $('#modal-title').html('<i class="fa fa-trash"></i> Delete ' + title);
    } else if (type == 'detail') {
        $('#modal-title').html('<i class="fa fa-search"></i> Detail ' + title);
    } else if (type == 'filter') {
        $('#modal-title').html('<i class="fa fa-filter"></i> Filter ' + title);
    } else if (type == 'confirm') {
        $('#modal-title').html('<i class="fa fa-check"></i> Konfirmasi ' + title);
    } else if (type == 'search-invoice') {
        $('#modal-title').html('<i class="mdi mdi-feature-search-outline"></i> Cari Pesanan');
    } else if (type == 'login') {
        $('#modal-title').html('<i class="mdi mdi-login"></i> Login');
    } else if (type == 'register') {
        $('#modal-title').html('<i class="mdi mdi-account-plus-outline"></i> Register');
    } else if (type == 'forgot-password') {
        $('#modal-title').html('<i class="mdi mdi-feature-search-outline"></i> Cari Pesanan');
    } else {
        $('#modal-title').html(title);
    }
    if (type == 'add' || type == 'edit' || type == 'reply' || type == 'send') {
        $('#modal-footer').addClass('hidden');
    } else {
        $('#modal-footer').removeClass('hidden');
    }
    $.ajax({
        type: "GET",
        url: url,
        beforeSend: function () {
            Swal.fire({
                title: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: function () {
                    Swal.showLoading()
                }
            })
            $('#modal-detail-body').html('<div class="text-center"><div class="loader-box"><div class="loader-3"></div></div></div>');
        },
        success: function (result) {
            $('#modal-form').modal({
                backdrop: 'static',
                keyboard: false
            });
            if (result.type == 'json') {
                if (result.status == false) {
                    Swal.fire("Gagal!", result.msg, "error");
                    $('#modal-form').modal('hide');
                } else {
                    $('#modal-form').modal('show');
                    $('#modal-detail-body').html(result.data);
                }

            } else {
                $('#modal-form').modal('show');
                $('#modal-detail-body').html(result);
            }
            swal.close();
        },
        error: function () {
            $('#modal-form').modal('hide');
            Swal.fire("Gagal!", "Terjadi kesalahan.", "error");
        }
    });
    $('#modal-detail').modal();
}
function modalUser(type = '', title = 'Data', url) {
    if (type == 'add') {
        $('#modal-title-user').html('<i class="fa fa-plus-square"></i> Add ' + title);
    } else if (type == 'send') {
        $('#modal-title-user').html('<i class="fa fa-plus-square"></i> Kirim ' + title);
    } else if (type == 'edit') {
        $('#modal-title-user').html('<i class="fa fa-edit"></i> Edit ' + title);
    } else if (type == 'reply') {
        $('#modal-title-user').html('<i class="fa fa-edit"></i> Balas ' + title);
    } else if (type == 'delete') {
        $('#modal-title-user').html('<i class="fa fa-trash"></i> Delete ' + title);
    } else if (type == 'detail') {
        $('#modal-title-user').html('<i class="fa fa-search"></i> Detail ' + title);
    } else if (type == 'filter') {
        $('#modal-title-user').html('<i class="fa fa-filter"></i> Filter ' + title);
    } else if (type == 'confirm') {
        $('#modal-title-user').html('<i class="fa fa-check"></i> Konfirmasi ' + title);
    } else if (type == 'search-invoice') {
        $('#modal-title-user').html('<i class="mdi mdi-feature-search-outline"></i> Cari Pesanan');
    } else if (type == 'login') {
        $('#modal-title-user').html('<i class="mdi mdi-login"></i> Login');
    } else if (type == 'register') {
        $('#modal-title-user').html('<i class="mdi mdi-account-plus-outline"></i> Register');
    } else if (type == 'forgot-password') {
        $('#modal-title-user').html('<i class="mdi mdi-feature-search-outline"></i> Cari Pesanan');
    } else {
        $('#modal-title-user ').html(title);
    }
    if (type == 'add' || type == 'edit' || type == 'reply' || type == 'send') {
        $('#modal-footer-user').addClass('hidden');
    } else {
        $('#modal-footer-user').removeClass('hidden');
    }
    $.ajax({
        type: "GET",
        url: url,
        beforeSend: function () {
            swal.fire({
                title: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: function () {
                    swal.showLoading()
                }
            })
            $('#modal-detail-body-user').html('<div class="text-center"><div class="loader-box"><div class="loader-3"></div></div></div>');
        },
        success: function (result) {
            $('#modal-form-user').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal-form-user').modal('show');
            if (result.type == 'json') {
                if (result.status === false) {
                    Swal.fire("Gagal!", result.msg, "error");
                    $('#modal-form-user').modal('hide');
                } else {
                    $('#modal-detail-body-user').html(result.data);
                }

            } else {
                $('#modal-detail-body-user').html(result);
            }
            swal.close();
        },
        error: function () {
            $('#modal-form-user').modal('hide');
            Swal.fire("Gagal!", "Terjadi kesalahan.", "error");
        }
    });
    $('#modal-detail-user').modal();
}
// $('.select2').select2();

function info(data) {
    swal.fire("Informasi!", data, "info");
}

function deleteData(elt, id, title, url, info = '') {
    swal.fire({
        title: "Apakah anda yakin?",
        html: 'Hapus Permanen <b style="font-weight: bold;">' + title + '</b>?' + info,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak, Batalkan!",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: url,
                type: 'POST',
                data: '_method=DELETE',
                beforeSend: function () {
                    swal.fire({
                        title: 'Mohon Tunggu...',
                        allowOutsideClick: false,
                        didOpen: function () {
                            swal.showLoading()
                        },
                    })
                    $('#modal-detail-body').html('<div class="text-center"><div class="loader-box"><div class="loader-3"></div></div></div>');
                },
                error: function () {
                    swal.fire("Gagal", "Terjadi kesalahan.", "error");
                },
                success: function (data) {
                    if (data.result == false) {
                        swal.fire("Gagal", "Terjadi kesalahan.", "error");
                    } else {
                        $('#datatable').DataTable().draw('page');
                        swal.fire("Berhasil!", '<b style="font-weight: bold;">' + title + '</b> berhasil dihapus.', "success");
                    }
                }
            });
        } else {
            swal.fire("Dibatalkan", "Hapus data dibatalkan.", "error");
        }
    });
}

function switchStatus(elt, id, url) {
    $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function () {
            swal.fire({
                title: 'Mohon Tunggu...',
                allowOutsideClick: false,
                didOpen: function () {
                    swal.showLoading()
                },
            })
        },
        error: function () {
            $('#datatable').DataTable().draw('page');
            Toast.fire("Gagal!", 'Terjadi kesalahan !.', "error");
        },
        success: function (data) {
            if (data.status == false) {
                $('#datatable').DataTable().draw('page');
                Toast.fire("Gagal!", data.msg, "error");
            } else {
                Toast.fire("Berhasil!", data.msg, "success");
                // if ($(elt).attr('value') == '1') {
                //     $("label[for="+$(elt).attr('id')+"]").text('Aktif');
                // } else {
                //     $("label[for="+$(elt).attr('id')+"]").text('Nonaktif');
                // }
                $('#datatable').DataTable().draw('page');
            }
        }
    });
}
