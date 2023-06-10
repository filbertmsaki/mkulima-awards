<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-web.head-component />

<body>
    @if ($topheader)
        <!-- top-Navigation -->
        <x-web.top-header-component />
    @endif
    @if ($header)
        <!-- Navigation -->
        <x-web.header-component />
    @endif
    {{ $slot }}
    <!-- footer -->
    @if ($footer)
        <x-web.footer-component />
        <x-web.copyright-component />
    @endif
    <!-- footer -->
    @stack('modals')
    <!-- Place all Scripts Here -->
    <!-- jQuery -->
    <script src="{{ asset('web/js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Popper -->
    <script src="{{ asset('web/js/popper.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Range Slider -->
    <script src="{{ asset('web/js/ion.rangeSlider.min.js') }}"></script>
    <!-- Swiper Slider -->
    <script src="{{ asset('web/js/swiper.min.js') }}"></script>
    <!-- Nice Select -->
    <script src="{{ asset('web/js/jquery.nice-select.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('web/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- VITTO Js -->
    <script src="{{ asset('web/js/main.js') }}"></script>
    <!-- /Place all Scripts Here -->
    @stack('scripts')
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('message'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.success("{{ session('message') }}");
            @endif
            @if (Session::has('error'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.error("{{ session('error') }}");
            @endif
            @if (Session::has('info'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.info("{{ session('info') }}");
            @endif
            @if (Session::has('warning'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.warning("{{ session('warning') }}");
            @endif
            @if (Session::has('success'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.success("{{ session('success') }}");
            @endif
            @if (Session::has('danger'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.error("{{ session('danger') }}");
            @endif
        });
    </script>
</body>

</html>
