<x-guest-layout>
    @section('title', 'Awards Categories')
    @push('css')
        <style>

        </style>
    @endpush
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('body').on('click', '.btn-vote', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var url = "{{ route('web.awards.votes.store') }}";

                    if (id != '') {
                        $.ajax({
                            type: "post",
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}",
                                nominee: id,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.success) {
                                    console.log(data);
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true,
                                        "positionClass": "toast-top-right"
                                    }
                                    toastr.success(data.success);
                                } else {
                                    console.log(data);
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true,
                                        "positionClass": "toast-top-right"
                                    }
                                    toastr.error(data.error);
                                }

                            },
                            error: function(data) {

                            }
                        });
                    }

                });
            });
        </script>
    @endpush
    @push('modals')
    @endpush
    <!-- breadcrumb -->
    <div class="breadcrumb-area">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="breadcrumb-content">
                <h2>@yield('title')</h2>
                <ul>
                    <li><a href="{{ route('web.index') }}">Home</a>
                    </li>
                    <li class="active">@yield('title')</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <section class="section-padding ex-collection bg-theme-primary">
        <div class="container ">
            <div class="row d-flex flex-wrap">
                <div class="col-12">
                    <div class="section-header-left d-flex justify-content-center">
                        <h3 class="text-light-black header-title title text-center">Kilimo Award Categories </h3>
                    </div>
                </div>
                @foreach ($nominees as $nominee)
                    <div class="col-md-3 col-6 d-flex w-100 sa-causes-single-col">
                        <div class="sa-causes-single sa-causes-single-2 d-flex flex-column">
                            <div class="causes-details-wrap relative">
                                <div class="causes-details d-flex justify-content-center ">
                                    <span class="icon-Group text-primary fs-22 text-primary mt-0 mb-0"><i class="fa fa-trophy"
                                            aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="causes-details">
                                    <h5 class="text-center fs-18">{{ $nominee->service_name }}</h5>
                                    <div class=" text-center fw-400 text-fade fs-16 mb-1 mt-1"> {!! $share !!}
                                    </div>
                                </div>
                            </div>
                            <div class="btn-area text-center w-100 mt-auto" >
                                <a class="btn-donation text-btn fs-12 full-width btn-vote" data-id="{{ $nominee->id }}"
                                    href="javascript:void(0)">VOTE</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-guest-layout>
