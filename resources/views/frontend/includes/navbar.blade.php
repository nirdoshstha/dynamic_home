<header>
    <div class="top__header">
        <div class="container">
            <div class="top__header-wrapper d-flex justify-content-between align-items-center">
                <div class="left__wrapper d-flex align-items-center">
                    <div class="inquiry__wrapper">
                        <a href="#" class="me-4 show" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="true">
                            <div class="phone__class d-flex align-items-center">
                                <div class="icon__holder">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="inquiry">
                                    <p class="mb-0">For Inquiry</p>
                                </div>
                            </div>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @if (isset(setting()->phone))
                                <li>
                                    <a class="dropdown-item pt-0 text-dark" href="tel: {{ setting()->phone ?? '' }}"><i
                                            class="fa-solid fa-phone text-success"></i> {{ setting()->phone ?? '' }}</a>
                                </li>
                            @endif

                            @if (isset(setting()->mobile))
                                <li>
                                    <a class="dropdown-item text-dark" href="tel: {{ setting()->mobile ?? '' }}">
                                        <i class="fa-solid fa-phone text-success"></i>
                                        {{ setting()->mobile ?? '' }}</a>
                                </li>
                            @endif

                            @if (isset(setting()->viber))
                                <li>
                                    <a class="dropdown-item text-dark" href="tel: {{ setting()->viber ?? '' }}">
                                        <i class="fab fa-viber text-success"></i>
                                        {{ setting()->viber ?? '' }}</a>
                                </li>
                            @endif

                            @if (isset(setting()->whatsapp))
                                <li>
                                    <a class="dropdown-item text-dark" href="tel: {{ setting()->whatsapp ?? '' }}">
                                        <i class="fab fa-whatsapp text-success"></i>
                                        {{ setting()->whatsapp ?? '' }}</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                    <div class="email__wrapper">
                        <a href="#" class="me-4 show" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="true">
                            <div class="phone__class d-flex align-items-center">
                                <div class="icon__holder">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="inquiry">
                                    <p class="mb-0">Send Mail</p>
                                </div>
                            </div>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @if (isset(setting()->email))
                                <li><a class="dropdown-item pt-0 text-dark"
                                        href="Mailto: {{ setting()->email ?? '' }}"><i
                                            class="fa-solid fa-envelope text-success"></i>
                                        {{ setting()->email ?? '' }}</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>

                <div class="right__wrapper d-flex justify-content-end">
                    <div class="location listed__items">
                        <span><i class="fa-solid fa-location-dot"></i> {{ setting()->address ?? '' }}</span>
                    </div>
                    <div class="location listed__items">
                        <span> <a href="{{ route('frontend.alumni') }}"> Alumni</a></span>
                    </div>
                    <div class="social_icon d-flex justify-content-center align-items-center listed__items">
                        @foreach (social_media() as $socials)
                            <a href="{{ $socials->link }}"><i class="{{ $socials->icon }}"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">

            <a class="navbar-brand" href="{{ route('frontend.index') }}">
                <div class="logo">
                    @if (isset(setting()->logo))
                        <img src="{{ asset('storage/' . setting()->logo) }}" width="100%" height="100%"
                            alt="">
                    @else
                        <img src="{{ asset('frontend/assets/img/logo-2.png') }}" width="100%" height="100%"
                            alt="">
                    @endif
                </div>
            </a>

            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">

                    <li class="nav-item dropdown {{ Request::is('about-us/*', 'about-us') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="{{ route('frontend.about_single') }}"
                            id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.about_single') }}">Who we are</a>
                            </li>
                            @foreach (category_abouts() as $categories)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('frontend.about_us', $categories->slug) }}">{{ $categories->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown {{ Request::is('message/*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Message
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">

                            @foreach (message() as $messages)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('frontend.message', $messages->slug) }}">{{ $messages->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown {{ Request::is('information/*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Information
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">

                            @foreach (information() as $informations)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('frontend.information', $informations->slug) }}">{{ $informations->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item dropdown {{ Request::is('kindergarten/*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kindergarten
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">

                            @foreach (kindergarten() as $kindergartens)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('frontend.kindergarten', $kindergartens->slug) }}">{{ $kindergartens->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item dropdown {{ Request::is('photo-album', 'video-gallery') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gallery
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.photo_album') }}">Album</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.video') }}">Videos</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{ Request::is('news-and-events') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.news_events') }}">News & Events</a>
                    </li>
                    <li class="nav-item {{ Request::is('notice') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.notice') }}">Notice</a>
                    </li>
                    <li class="nav-item dropdown {{ Request::is('download') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Downloads
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">

                            @foreach (downloads() as $download)
                                <li class="{{ Request::is('download') ? 'active' : '' }}">
                                    <a class="dropdown-item" target="_blank"
                                        href="{{ asset('storage/' . $download->image) }}"> {{ $download->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.contact') }}">Contact Us</a>
                    </li>
                </ul>
            </div>


            <div class="celebration">
                @if (isset(setting()->fav_icon))
                    <img src="{{ asset('storage/' . setting()->fav_icon) }}" width="100%" height="100%"
                        alt="">
                @else
                    <img src="{{ asset('frontend/assets/img/10_year_celebration.png') }}" width="100%"
                        height="100%" alt="">
                @endif
            </div>
            <button class="navbar-toggler my-1" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
</header>
