<x-guest-layout>
    @section('title', $category->name)
    @push('css')
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
                <h2>Category</h2>
                <ul>
                    <li><a href="{{ route('web.index') }}">Home</a>
                    </li>
                    <li><a href="{{ route('web.awards.categories.index') }}">Categories</a>
                    </li>
                    <li class="active">@yield('title')</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- Blog -->
    <section class="our-articles bg-light-theme section-padding ">
        <div class="container-fluid custom-container">
            <div class="main-box padding-20 full-width mb-md-40">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-meta mb-xl-20">
                            <h5 class="blog-title text-light-black">{{ $category->name }}</h5>

                            {!! $category->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
