<x-guest-layout>
    @section('title', 'Voting Categories')
    @push('css')
        <style>

        </style>
    @endpush
    @push('scripts')
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
                        <h3 class="text-light-black header-title title text-center">@yield('title')</h3>
                    </div>
                </div>
                @foreach ($categories as $category)
                    <div class="col-md-3 col-6 d-flex">
                        <div class="sa-causes-single sa-causes-single-2 d-flex flex-column">
                            <div class="causes-details-wrap relative">
                                <div class="causes-details d-flex justify-content-center">
                                    <span class="icon-Group text-primary fs-22 text-primary"><i class="fa fa-trophy"
                                            aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="causes-details text-center">
                                    <h5 class="text-center fs-18">{{ $category->category->name }}</h5>
                                    <span class=" text-capitalize text-success">({{ $category->nominees }}) nominees</span>
                                </div>

                            </div>
                            <div class="btn-area text-center w-100 mt-auto">
                                <a class="btn-donation text-btn fs-12 full-width"
                                    href="{{ route('web.awards.votes.show', $category->category->slug) }}">Vote Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
</x-guest-layout>
