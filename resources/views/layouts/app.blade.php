<!DOCTYPE html>
<html lang="en">
<x-admin.head-component />

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <x-admin.navbar-component />
        <!-- /.navbar -->
        <x-admin.aside-component />
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            {{ $slot }}
        </div>
        <!-- /.content-wrapper -->
        <x-admin.footer-component />
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <x-admin.scripts-component />
</body>

</html>
