<x-guest-layout>
    @section('title', 'About Us')
    @push('css')
        <style>
            .list-policy p {
                margin-top: 0;
                /* Remove top margin */
            }

            .list-policy h6 {
                margin-bottom: 5px;
                /* Remove top margin */
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
                <h2 class=" text-capitalize">PRIVACY POLICY</h2>
                <ul>
                    <li><a href="{{ route('web.index') }}">Home</a>
                    </li>
                    <li class="active text-capitalize">MKULIMA AWARDS PRIVACY POLICY</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <section class="our-articles bg-light-theme section-padding ">
        <div class="container">
            <div class="main-box padding-20 full-width sa-causes-single sa-causes-single-2 mb-md-40">



                <div class="row m-1">
                    <div class="col-12">
                        <div class="profile-content">
                            <h5 class="blog-title text-light-black">Last Updated: February 2024</h5>
                            <p>Mkulima Awards is committed to protecting your privacy. This Privacy Policy outlines how
                                we collect, use, disclose, and safeguard your personal information when you use our
                                website and mobile applications ("apps"). By accessing or using our services, you agree
                                to the terms of this Privacy Policy.
                            </p>
                            <ol class="list-policy">
                                <li>
                                    <h6>Information We Collect:</h6>
                                    <p>Personal Information: We may collect personally identifiable information, such as
                                        your name, email address, contact details, and other relevant information when
                                        you register for the Mkulima Awards, participate in events, or use our apps.</p>
                                </li>
                                <li>
                                    <h6>How We Use Your Information:</h6>
                                    <p>We use your information to provide, maintain, and improve our services, including
                                        event registration, communication, and participant tracking. Your data may also
                                        be used for analytics, research, and marketing purposes.</p>
                                </li>
                                <li>
                                    <h6>Information Sharing:</h6>
                                    <p>We do not sell, trade, or rent your personal information to third parties. Your
                                        data may be shared with event organizers, sponsors, or service providers who
                                        assist us in delivering our services, subject to confidentiality agreements.</p>
                                </li>
                                <li>
                                    <h6>Location Information:</h6>
                                    <p>Our apps may collect location information to provide location-based services,
                                        such as event venue navigation. You can disable location services in your device
                                        settings.</p>
                                </li>
                                <li>
                                    <h6>Data Security:</h6>
                                    <p>We implement industry-standard security measures to protect your personal
                                        information from unauthorized access, disclosure, alteration, or destruction.
                                    </p>
                                </li>
                                <li>
                                    <h6>Cookies and Tracking:</h6>
                                    <p>We may use cookies and similar technologies to enhance your experience, analyze
                                        trends, and track user activities on our website and apps. You can adjust your
                                        browser settings to disable cookies.</p>
                                </li>
                                <li>
                                    <h6>Third-Party Links:</h6>
                                    <p>Our website and apps may contain links to third-party websites or services. We
                                        are not responsible for the privacy practices of such entities, and we recommend
                                        reviewing their privacy policies.</p>
                                </li>
                                <li>
                                    <h6>Your Choices:</h6>
                                    <p>You have the right to access, update, or delete your personal information. You
                                        may opt-out of receiving promotional communications from us by following the
                                        instructions in the emails we send.</p>
                                </li>
                                <li>
                                    <h6>Children's Privacy:</h6>
                                    <p>Our services are not directed to individuals under the age of 13. We do not
                                        knowingly collect personal information from children. If you are a parent or
                                        guardian and believe your child has provided us with information, please contact
                                        us.</p>
                                </li>
                                <li>
                                    <h6>Changes to This Privacy Policy:</h6>
                                    <p>We may update this Privacy Policy periodically. The revised version will be
                                        effective as of the "Last Updated" date. We encourage you to review this page
                                        for any changes.</p>
                                </li>
                                <li>
                                    <h6>Contact Us:</h6>
                                    <p>For any questions, concerns, or requests related to this Privacy Policy, please
                                        contact us at <a
                                            href="mailto:info@mkulimaawards.co.tz">info@mkulimaawards.co.tz</a>.</p>
                                </li>
                            </ol>
                            <p>By using our website and apps, you acknowledge that you have read and understood this
                                Privacy Policy.</p>

                        </div>
                    </div>
                </div>
    </section>
</x-guest-layout>
