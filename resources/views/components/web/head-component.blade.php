<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="#">
    <meta name="description" content="#">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="#">
    <link rel="apple-touch-icon-precomposed" href="#">
    <link rel="shortcut icon" href="#">
    <!-- Bootstrap -->

    <link href="{{ asset('web/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Fontawesome -->

    <link href="{{ asset('web/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    <!-- Flaticons -->
    <link href="{{ asset('web/css/font/flaticon.css') }}" rel="stylesheet">
    <!-- Pe-icons -->
    <link href="{{ asset('web/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <!-- Swiper Slider -->
    <link href="{{ asset('web/css/swiper.min.css') }}" rel="stylesheet">
    <!-- Range Slider -->
    <link href="{{ asset('web/css/ion.rangeSlider.min.css') }}" rel="stylesheet">
    <!-- magnific popup -->
    <link href="{{ asset('web/css/magnific-popup.css') }}" rel="stylesheet">
    <!-- Nice Select -->
    <link href="{{ asset('web/css/nice-select.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('web/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('web/css/responsive.css') }}" rel="stylesheet">

    @stack('css')

</head>
