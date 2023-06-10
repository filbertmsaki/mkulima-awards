<x-app-layout>
    @section('title', 'Dashboard')
    @push('css')
    @endpush
    @push('scripts')
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>
    @endpush
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ number_format($categories_count,0,'.',',') }}</h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list"></i>
                        </div>
                        <a href="{{ route('admin.award-category.index') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($nominees_count,0,'.',',') }}</h3>
                            <p>Nominees</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('admin.award-nominee.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ number_format($votes_count,0,'.',',') }}</h3>
                            <p>Votes</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-vote-yea"></i>
                        </div>
                        <a href="{{ route('admin.award-voting.show', \Carbon\Carbon::now()->format('Y')) }}"
                            class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</x-app-layout>
