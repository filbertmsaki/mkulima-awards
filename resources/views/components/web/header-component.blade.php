<header class="header">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-12">
                <div class="navigation ">
                    <div class="logo">
                        <a href="{{ route('web.index') }}">
                            <img src="{{ asset('web/img/logo1.png') }}" class="image-fit" alt="logo">
                        </a>
                    </div>
                    <div class="main-navigation">
                        <nav>
                            <ul class="main-menu">
                                <li class="menu-item"> <a href="{{ route('web.index') }}"
                                        class="text-light-black">Home</a>
                                </li>
                                <li class="menu-item"> <a href="{{ route('web.about-us') }}"
                                        class="text-light-black">About Us</a>
                                </li>
                                <li class="menu-item menu-item-has-children"> <a href="javascript:void(0)"
                                        class="text-light-black">Awards</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"> <a
                                                href="{{ route('web.awards.categories.index') }}">Awards Categories</a>
                                        </li>
                                        <li class="menu-item"> <a
                                                href="{{ route('web.awards.registration.index') }}">Award
                                                Registration</a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="menu-item"> <a href="{{ route('web.awards.votes.index') }}"
                                        class="text-light-black">Vote</a>
                                </li>
                                <li class="menu-item"> <a href="{{ route('web.contact-us') }}"
                                        class="text-light-black">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="right-side-navigation">
                        <ul>
                            <li class="hamburger-menu">
                                <a href="#" class="menu-btn"> <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
