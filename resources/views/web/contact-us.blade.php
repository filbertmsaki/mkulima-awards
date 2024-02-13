<x-guest-layout>
    @section('title', 'Contact Us')
    @push('css')
        <style>
            .info-wrap {
                color: rgba(255, 255, 255, 0.8);
            }

            .bg-primary {
                background: #006837 !important;
            }

            .info-wrap h3 {
                color: #fff;
            }

            .info-wrap .dbox {
                width: 100%;
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 25px;
            }

            .info-wrap .dbox .icon {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                border: 2px solid rgba(255, 255, 255, 0.2);
            }

            .info-wrap .dbox .icon span {
                font-size: 20px;
                color: #fff;
            }

            .info-wrap .dbox .text {
                width: calc(100% - 50px);
            }

            .info-wrap .dbox p {
                margin-bottom: 0;

            }

            .info-wrap .dbox p span {
                font-weight: 500;
                color: #fff;
            }

            .info-wrap .dbox p a {
                color: #fff;
            }


            @media (max-width: 991.98px) {
                .contact-form-div {
                    margin-top: 20px;
                }
            }
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
                <h2>Contact Us</h2>
                <ul>
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Contact us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <div class="contact_map d-flex">
    
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1253.5869127528638!2d37.663197964021485!3d-6.825455076256483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185a5dbea43fdcc9%3A0xce6bd3ac4d85934e!2sKorogwe%20Road%2C%20Morogoro!5e0!3m2!1sen!2stz!4v1707844063912!5m2!1sen!2stz" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <section class="section-padding bg-theme-primary">
        <div class="container">

            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="info-wrap bg-primary w-100 p-md-5 p-4">
                        <h3>Let's get in touch</h3>
                        <p class="mb-4">We're open for any suggestion or just to have a chat</p>
                        <div class="dbox w-100 d-flex align-items-start">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-map-marker"></span>
                            </div>
                            <div class="text pl-3">
                                <p><span>Address:</span>Korogwe Road, Block No 10 (Halotel Building), First Floor P.O Box 2380 Morogoro, Tanzania</p>
                            </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-phone"></span>
                            </div>
                            <div class="text pl-3">
                                <p><span>Phone:</span> <a href="tel://+255754222800">+255 754 222 800</a> | <a
                                        href="tel://255739300777"> +255 739 300 777</a></p>
                            </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-paper-plane"></span>
                            </div>
                            <div class="text pl-3">
                                <p><span>Email:</span> <a
                                        href="mailto:info@mkulimaawards.co.tz">info@mkulimaawards.co.tz</a></p>
                            </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-globe"></span>
                            </div>
                            <div class="text pl-3">
                                <p><span>Website</span> <a href="https://mkulimaawards.co.tz">mkulimaawards.co.tz</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 contact-form-div">
                    <div class="section-header-style-2">
                        <h3 class="text-light-black header-title">Get In Touch</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form class="form_validate ajax_submit form_alert"
                                action="{{ route('web.contact-us.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-light-black fw-600">Full Name</label>
                                            <input type="text" name="full_name"
                                                class="form-control form-control-submit @error('full_name') is-invalid @enderror"
                                                placeholder="Full Name" required>
                                            @error('full_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-light-black fw-600">Email Address</label>
                                            <input type="email" name="email"
                                                class="form-control form-control-submit @error('email') is-invalid @enderror"
                                                placeholder="Email I'd" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-light-black fw-600">Phone Number</label>
                                            <input type="text" name="phone"
                                                class="form-control form-control-submit @error('phone') is-invalid @enderror"
                                                placeholder="Phone No." required>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-light-black fw-600">Subject</label>
                                            <input type="text" name="subject"
                                                class="form-control form-control-submit @error('subject') is-invalid @enderror"
                                                placeholder="Subject" required>
                                            @error('subject')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-light-black fw-600">Message</label>
                                            <textarea class="form-control form-control-submit @error('message') is-invalid @enderror" name="message" rows="6"
                                                placeholder="Write Message" required></textarea>
                                            @error('message')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn-solid with-line btn-big mt-20 mr-1 full-width">Submit</button>
                                        <div class="server_response w-100"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</x-guest-layout>
