<x-guest-layout>
    @section('title', 'Home Page')
    @push('css')
        <style>
            #event-schedule {
                width: 100%;
                border-collapse: collapse;
            }

            #event-schedule th,
            #event-schedule td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            #event-schedule th {
                background-color: #f2f2f2;
            }

            #event-schedule ul li,
            #event-schedule ol li {
                list-style-type: lower-roman;
                margin-left: 20px
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            function makeEventTimer() {
                var event_date;
                var event_text;
                var is_registration_end = "{{ award_registration_period() }}";
                var is_voting_period_end = "{{ voting_period() }}";
                if (is_registration_end) {
                    var award_registration_start_on = "{{ $award_registration_start_on }}"
                    if (award_registration_start_on) {
                        event_date = "{{ $award_registration->start_date }}"
                        event_text = "Award Registration Will Start on"
                    } else {
                        event_date = "{{ $award_registration->end_date }}"
                        event_text = "Award Registration will End On"
                    }
                } else {
                    var voting_start_on = "{{ $voting_start_on }}"
                    if (voting_start_on) {
                        event_date = "{{ $voting->start_date }}"
                        event_text = "Voting will Start on"
                    } else {
                        event_date = "{{ $voting->end_date }}"
                        event_text = "Voting will End On"
                    }
                }
                var endTime = new Date(event_date);
                endTime = (Date.parse(endTime) / 1000);
                var now = new Date();
                now = (Date.parse(now) / 1000);
                var timeLeft = endTime - now;
                var days = Math.floor(timeLeft / 86400);
                var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
                var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
                if (hours < "10") {
                    hours = "0" + hours;
                }
                if (minutes < "10") {
                    minutes = "0" + minutes;
                }
                if (seconds < "10") {
                    seconds = "0" + seconds;
                }
                $("#awards-days").html(days + "<h6 class='mb-0'>Days</h6>");
                $("#awards-hours").html(hours + "<h6 class='mb-0'>Hours</h6>");
                $("#awards-minutes").html(minutes + "<h6 class='mb-0'>Minutes</h6>");
                $("#awards-seconds").html(seconds + "<h6 class='mb-0'>Seconds</h6>");
                $("#event_text").text(event_text);
            }
            setInterval(function() {
                makeEventTimer();
            }, 1000);
        </script>
    @endpush
    @push('modals')
        <div class="modal" id="quick_view">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                                <div class="col-lg-5 align-self-center">
                                    <div class="shop-detail-image">
                                        <div class="detail-slider">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a href="#" class="popup">
                                                            <img src="{{ asset('web/img/shop/maindetail.jpg') }}"
                                                                class="img-fluid full-width" alt="slider">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="shop-detail-contents mb-md-40 mt-md-40">
                                        <div class="shop-detail-content-wrapper">
                                            <h3 class="text-custom-black">Handmade Golden Necklace Full Family Package
                                            </h3>
                                        </div>
                                        <div class="ratings d-flex mb-xl-20"> <span class="text-yellow"><i
                                                    class="fas fa-star"></i></span>
                                            <span class="text-yellow"><i class="fas fa-star"></i></span>
                                            <span class="text-yellow"><i class="fas fa-star"></i></span>
                                            <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                            <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                            <div class="pro-review"> <span>1 Reviews</span>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <h4 class="text-custom-red price-tag">$45 <span
                                                    class="text-light-white fw-400 fs-14">$50</span></h4>
                                        </div>
                                        <div class="product-full-des mb-20">
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            </p>
                                        </div>
                                        <div class="availibity mt-20">
                                            <h6 class="text-custom-black fw-600">Avability: <span
                                                    class="text-success ml-2">In Stock</span></h6>
                                        </div>
                                        <div class="quantity mb-xl-20">
                                            <h6 class="text-custom-black mb-0 mr-2 fw-600">Qty:</h6>
                                            <div class="product-qty-input">
                                                <button class="minus-btn" type="button" name="button"> <i
                                                        class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="form-control form-control-qty text-center"
                                                    name="name" value="1">
                                                <button class="plus-btn" type="button" name="button"> <i
                                                        class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="shop-bottom">
                                            <div class="shop-meta mt-20">
                                                <h6 class="text-custom-black mb-0 fw-600">Categories:</h6>
                                                <ul class="list-inline ml-2">
                                                    <li class="list-inline-item"><a href="#">Necklace</a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#">Diamond</a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#">Sale</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="shop-meta mt-20">
                                                <h6 class="text-custom-black mb-0 fw-600">Tags:</h6>
                                                <ul class="list-inline ml-2">
                                                    <li class="list-inline-item"><a href="#">Luxary</a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#">Diamond</a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#">New Arrivel</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-btn mt-20"> <a href="#"
                                                    class="btn-solid with-line ml-2">Add to Cart <i
                                                        class="pe-7s-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- product details inner end -->
                    </div>
                </div>
            </div>
        </div>
    @endpush
    <div class="main-sec"></div>
    <!-- slider -->
    <section class="about-us-slider swiper-container p-relative slider-banner-1">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide-item">
                <img src="{{ asset('web/images/slider-1.jpg') }}" class="img-fluid full-width" alt="Banner">
                <div class="transform-center z-index-3">
                    <div class="container-fluid custom-container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 align-self-center">
                                <div class="right-side-content far-right">
                                    <h1 class="text-white fw-600">MKULIMA AWARDS<span
                                            class="text-custom-pink">2024</span></h1>
                                    <p class="text-white fw-400">Growing Tomorrow: Recognizing the Best in Agriculture
                                        Today</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay overlay-bg-dark overlay-bg-img"></div>
            </div>
            <div class="swiper-slide slide-item">
                <img src="{{ asset('web/images/image-2.jpg') }}" class="img-fluid full-width" alt="Banner">
                <div class="transform-center z-index-3">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 align-self-center">
                                <div class="right-side-content text-center">
                                    <h5 class="text-white">Join us Today.</h5>
                                    <h1 class="text-white fw-600">To pay tribute to <span
                                            class="text-custom-pink">agricultural entrepreneurs </span></h1>
                                    <p class="text-white fw-400">Mkulima Awards provide a platform for showcasing
                                        exemplary models and success stories in these sectors.</p>
                                    <a href="{{ route('web.contact-us') }}"
                                        class="btn-solid with-line btn-big mt-20 mr-1"><span>Contact Us <i
                                                class="fas fa-caret-right"></i></span></a>
                                    <a href="{{ route('web.about-us') }}" class="border-butn mt-20 ml-1"><span>Learn
                                            More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay overlay-bg-dark overlay-bg-img"></div>
            </div>

        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </section>
    <!-- slider -->
    <section class="service-type">
        <div class="row">
            <div class="col-lg-3 col-md-6 bg-custom-1 border-custom-right border-sm-bottom">
                <div class="service-box">
                    <div class="service-box-wrapper">
                        <div class="service-icon-box">
                            <img src="{{ asset('web/img/help.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="service-text-box">
                            <p>Participate</p>
                            <h6>As a Nominee</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 bg-custom-2 border-custom-right border-sm-bottom">
                <div class="service-box">
                    <div class="service-box-wrapper">
                        <div class="service-icon-box">
                            <img src="{{ asset('web/img/money.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="service-text-box">
                            <p>Be a Hand</p>
                            <h6>As a Sponsor</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 bg-custom-3 border-custom-right border-sm-bottom">
                <div class="service-box">
                    <div class="service-box-wrapper">
                        <div class="service-icon-box">
                            <img src="{{ asset('web/img/investor.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="service-text-box">
                            <p>Participate</p>
                            <h6>As a Voter</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 bg-custom-4">
                <div class="service-box">
                    <div class="service-box-wrapper">
                        <div class="service-icon-box">
                            <img src="{{ asset('web/img/cash.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="service-text-box">
                            <p>Be a Part</p>
                            <h6>In our Mission</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About section -->
    <section class="our-articles bg-light-theme section-padding ">
        <div class="container">
            <div class=" padding-20 full-width  sa-causes-single-2 mb-md-40">
                <div class="post-wrapper mb-xl-20">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="profile-img full-height">
                                <img src="{{ asset('web/images/image-1.jpg') }}" alt="img" class="image-fit">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="profile-content">
                                <h4>The Mkulima Awards</h4>
                                <p>Welcome to the Mkulima Awards, a prestigious event held annually to recognize and
                                    commend stakeholders in the agriculture, environment, and tourism sectors in
                                    Tanzania. 2024 marks the third consecutive year of these awards, which aim to
                                    celebrate and honor the remarkable achievements of individuals and organizations in
                                    these vital industries.
                                </p>
                                <p>Join us as we come together to applaud the remarkable efforts and accomplishments of
                                    our stakeholders at the Mkulima Awards. Together, let us celebrate the
                                    transformative power of the agriculture, environment, and tourism sectors in shaping
                                    our nation's future.</p>
                                <div class="bottom-group">
                                    <a href="{{ route('web.about-us') }}" class="btn-solid with-line"><span>Read More
                                            <i class="fas fa-caret-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <!-- Mission Card -->
                        <div class="col-md-6">
                            <div class="card d-flex h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-bullseye"></i> Mission</h5>
                                    <p class="card-text">To recognize and honor outstanding individuals and
                                        organizations
                                        in
                                        more than 40 award categories related to agriculture and environmental
                                        achievements.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Target Card -->
                        <div class="col-md-6">
                            <div class="card d-flex h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-crosshairs"></i> Target</h5>
                                    <p class="card-text">A formal awards ceremony featuring keynote speakers, category
                                        announcements, and special performances.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <section class="about-section-style-1">
        <div class="row no-gutters">

            <div class="col-lg-6 bg-custom-primary">
                <div class="about-section-container">
                    <div class="section-header-left pb-0">
                        <h3 class="header-title text-white mb-1">Execution of Mkulima Awards</h3>
                        <p class="text-white">Keynote speeches from industry leaders addressing the significance of the
                            awards and the impact of the recipients’ contributions. </p>
                        <p class="text-white">Awards presented in various categories, with sponsors having the
                            opportunity to present specific awards. </p>
                        <p class="text-white">Special performances and entertainment acts interspersed with the awards
                            to maintain a celebratory atmosphere. </p>
                        <p class="text-white">Winners’ profiles and achievements highlighted, creating a memorable and
                            inspiring experience for attendees. </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="full-height">
                    <img src="{{ asset('web/images/image-3.jpg') }}" alt="img"
                        class="img-fluid full-width full-height border-0" style="border-radius: 0px">
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding ex-collection bg-theme-primary">
        <div class="container ">
            <div class="row d-flex flex-wrap">
                <div class="col-12">
                    <div class="section-header-left ">
                        <h3 class="text-light-black header-title title text-left">Kilimo Award Categories </h3>
                        <p class=" mt-2">
                            Mkulima Awards is an excellent initiative that recognizes and celebrates the efforts of
                            farmers and agriculture stakeholders in Tanzania. The event aims to promote, inspire and
                            compliment agriculture stakeholders and farmers who have made significant contributions to
                            the growth and development of the agriculture sector.
                        </p>
                    </div>
                </div>
                @foreach ($categories as $category)
                    <div class="col-md-3 col-6 d-flex">
                        <div class="sa-causes-single sa-causes-single-2  d-flex flex-column">
                            <div class="causes-details-wrap relative">
                                <div class="causes-details d-flex justify-content-center">
                                    <span class="icon-Group text-primary fs-22 text-primary"><i class="fa fa-trophy"
                                            aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="causes-details">
                                    <h5 class="text-center fs-18">{{ $category->name }}</h5>
                                </div>
                            </div>
                            <div class="btn-area text-center w-100 mt-auto">
                                <a class="btn-donation text-btn fs-12 full-width"
                                    href="{{ route('web.awards.categories.show', $category->slug) }}">View
                                    Category</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12">
                    <div class="bottom-group">
                        <a href="{{ route('web.awards.categories.index') }}"
                            class="btn-solid with-line float-right"><span>Read More
                                <i class="fas fa-caret-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding advertisement-banner-1 center-bg-effect"
        style="background-image: url({{ asset('web/images/image-2.jpg') }})">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="advertisement-text-1 center-block-div">
                        <h6 class="sub-head">Mkulima Award Nomination</h6>
                        <h3 class="text-white heading">Lets Change The Agriculture <span class="text-white">Sector In
                                Tanzania</span></h3>
                        <p id="event_text"></p>
                        <div class="ad-count justify-content-center">
                            <div class="countdown-box">
                                <div class="time-box"> <span id="awards-days"></span>
                                </div>
                                <div class="time-box"> <span id="awards-hours"></span>
                                </div>
                                <div class="time-box"> <span id="awards-minutes"></span>
                                </div>
                                <div class="time-box"> <span id="mb-seconds"></span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('web.awards.registration.index') }}"
                            class="btn btn-text btn-text-white mt-20">Become A Nominee</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="our-articles bg-light-theme section-padding ">
        <div class="container">
            <div class=" padding-20 full-width  sa-causes-single-2 mb-md-40">
                <div class="post-wrapper mb-xl-20">
                    <h3 class="text-light-black header-title title text-left">Event Schedule</h3>
                    <table id="event-schedule">
                        <tr>
                            <th>Time</th>
                            <th>Program</th>
                        </tr>
                        <tr>
                            <td>5:00 PM – 6:00 PM</td>
                            <td>
                                <p>Registration and Welcome Reception</p>
                                <ul type="1">
                                    <li>Guests arrive and register</li>
                                    <li>Networking and welcome drinks</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>6:00 PM – 6:30 PM</td>
                            <td>
                                <p>Opening Ceremony</p>
                                <ul type="1">
                                    <li>Welcome address by the Master of Ceremonies</li>
                                    <li>National anthem</li>
                                    <li>Official opening by the Guest of Honor</li>
                                    <li>Remarks by the Guest of Honor</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>6:30 PM – 7:00 PM</td>
                            <td>
                                <p>Keynote Speeches</p>
                                <ul type="1">
                                    <li>Distinguished keynote speakers addressing key issues in agriculture and the
                                        environment</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>7:00 PM – 8:00 PM</td>
                            <td>
                                <p>Gala Dinner</p>
                                <ul type="1">
                                    <li>Buffet-style dinner served</li>
                                    <li>Networking and informal discussions</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>8:00 PM – 9:00 PM</td>
                            <td>
                                <p>Panel Discussions</p>
                                <ul type="1">
                                    <li>Panel discussions on pertinent industry topics related to agriculture and the
                                        environment</li>
                                    <li>Q&A session with the audience</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>9:00 PM – 9:30 PM</td>
                            <td>
                                <p>Showcase of Innovative Projects</p>
                                <ul type="1">
                                    <li>Presentation of innovative projects in agriculture and environmental sectors
                                    </li>
                                    <li>Shortlisted projects highlighted with visual presentations</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>9:30 PM – 10:30 PM</td>
                            <td>
                                <p>Grand Awards Ceremony</p>
                                <ul type="1">
                                    <li>Recognition and awards presentation in more than 40 categories</li>
                                    <li>Sponsor representatives present awards</li>
                                    <li>Special performances and entertainment acts</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>10:30 PM – 11:00 PM</td>
                            <td>
                                <p>Closing Remarks</p>
                                <ul type="1">
                                    <li>Acknowledgments and thank you notes</li>
                                    <li>Announcement of future events and initiatives</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>11:00 PM Onwards</td>
                            <td>
                                <p>Networking and Entertainment</p>
                                <ul type="1">
                                    <li>DJ and dancing</li>
                                    <li>Networking, socializing, and celebrating the achievements in agriculture and the
                                        environment</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
