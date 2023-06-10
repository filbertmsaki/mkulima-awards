<x-app-layout>
    @section('title', 'Create Award Category')
    @push('css')
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script>
            $('#description').summernote({
                height: 200
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

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.award-category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Category Description</label>
                        <textarea id="description" name="description" rows="20" class="form-control" required>
                          </textarea>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-right">Create Category</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->

</x-app-layout>
