<x-app-layout>
    @section('title', 'Votes List')
    @push('css')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endpush
    @push('scripts')
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <script>
            var table = $('#categories_table').DataTable({
                processing: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                pageLength: 10,
                responsive: false,
                lengthChange: true,
                autoWidth: true,
                scrollY: false,
                scrollX: true,
                scrollCollapse: false,
                paging: true,
                dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [{
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        titleAttr: 'Excel',
                        title: 'Nominees Vote list ',
                        className: 'btn btn-success btn-sm',
                        footer: true,
                        autoPrint: false,
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        titleAttr: 'PDF',
                        title: 'Nominees Vote list ',
                        className: 'btn btn-info btn-sm',
                        footer: true,
                        orientation: 'landscape',
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        titleAttr: 'Print',
                        title: 'Nominees Vote list ',
                        className: 'btn btn-primary btn-sm',
                        footer: true,
                        orientation: 'landscape',
                    },
                ]
            });
        </script>
    @endpush
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@yield('title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="categories_table" class="table table-bordered table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Nominee Name</th>
                                        <th>Category Name</th>
                                        <th>Total Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($votes as $vote)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ @$vote->nominee->service_name }}</td>
                                            <td>{{ @$vote->category->name }}</td>

                                            <td>{{ @$vote->total_votes }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

</x-app-layout>
