<x-app-layout>
    @section('title', 'Nominee List')
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
                        title: 'Nominees list ',
                        className: 'btn btn-success btn-sm',
                        footer: true,
                        autoPrint: false,
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        titleAttr: 'PDF',
                        title: 'Nominees list ',
                        className: 'btn btn-info btn-sm',
                        footer: true,
                        orientation: 'landscape',
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        titleAttr: 'Print',
                        title: 'Nominees list ',
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
                                        <th>Contact Person Name</th>
                                        <th>Contact Person Phone</th>
                                        <th>Contact Person Email</th>
                                        <th>Category</th>
                                        <th>Entry</th>
                                        <th>Verified</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nominees as $nominee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nominee->service_name }}</td>
                                            <td>{{ $nominee->contact_person_name }}</td>
                                            <td>{{ $nominee->contact_person_phone }}</td>
                                            <td>{{ $nominee->contact_person_email }}</td>
                                            <td>{{ @$nominee->categories_name }}</td>
                                            <td> <span class="right badge badge-{{ $nominee->entry->value }}">{{ $nominee->entry->name }}</span>  </td>
                                            <td> <span class="right badge badge-{{ $nominee->verified->value }}">{{ $nominee->verified->name }}</span></td>
                                            <td class="d-flex justify-content-center">
                                                <div class="btn-group ">
                                                    <a href="{{ route('admin.award-nominee.edit', $nominee->id) }}"
                                                        class="btn btn-outline-primary btn-sm" data-toggle="tooltip"
                                                        data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit</a>
                                                    <button id="delete" class="btn  btn-outline-danger btn-sm"
                                                        onclick="
                                                    event.preventDefault();
                                                    if (confirm('Are you sure? It will delete the data permanently!')) {
                                                    document.getElementById('destroy{{ $nominee->id }}').submit()
                                                    }
                                                    ">
                                                        <i class="fa fa-trash"></i> Delete
                                                        <form id="destroy{{ $nominee->id }}" class="d-none"
                                                            action="{{ route('admin.award-nominee.destroy', $nominee->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </button>
                                                </div>
                                            </td>
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
