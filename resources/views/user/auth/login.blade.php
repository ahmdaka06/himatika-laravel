@extends('layouts.auth.app')
@section('title')
{{ $page['title'] }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
            <a href="{{ url('') }}" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bold text-uppercase">HIMATIKA</span>
            </a>
        </div>
        <!-- /Logo -->
        <p class="mb-4 text-center">Administration Login</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('user.auth.loginPOST') }}" method="POST">
            @method('POST')
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email </label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
                <small class="text-danger email-invalid"></small>
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                </div>
                <small class="text-danger password-invalid"></small>
            </div>
            {{-- <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
            </div> --}}
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </form>

    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#formAuthentication').on('submit', function(e) {
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
                        $('#formAuthentication')[0].reset();
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
