<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="keywords" content="himatika, himpunan mahasiswa teknik informatika, himatika undar, @himatika, himpunan mahasiswa teknik informatika darul ulum, universitas darul ulum, fakultas teknik, arek teknik, mahasiswa teknik">
    <meta name="description" content="Himatika Universitas Darul Ulum adalah himpunan mahasiswa Teknik Informatika dari Universita Darul Ulum Jombang.">
    <meta name="subject" content="Himpunan Mahasiswa Teknik Informatika Darul Ulum Jombang">
    <meta name="copyright" content="Himatika">
    <meta name="author" content="DolananKode X Himatika">

    <meta name='og:title' content='{{ request()->url() }}'>
    <meta name='og:type' content='website'>
    <meta name='og:url' content='{{ request()->url() }}'>
    <meta name='og:image' content='{{ url('storage/logo/logo-himatika.png') }}'>
    <meta name='og:site_name' content='himatika'>
    <meta name="og:description" content="Himatika Universitas Darul Ulum adalah himpunan mahasiswa Teknik Informatika dari Universita Darul Ulum Jombang.">
    <meta name="og:keyword" content="himatika, himpunan mahasiswa teknik informatika, himatika undar, @himatika, himpunan mahasiswa teknik informatika darul ulum, universitas darul ulum, fakultas teknik, arek teknik, mahasiswa teknik">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/') }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.3.67/css/materialdesignicons.min.css" integrity="sha512-nRzny9w0V2Y1/APe+iEhKAwGAc+K8QYCw4vJek3zXhdn92HtKt226zHs9id8eUq+uYJKaH2gPyuLcaG/dE5c7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link href="{{ url('/') }}/assets/vendor/libs/select2/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ url('/') }}/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('/') }}/assets/js/config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('styles')
  </head>
