@extends('frontend.layouts.master')

@section('title')
    Home Page
@endsection

@section('seo_keyword', 'the best school, school in nepal')
@section('seo_description', 'One of the best school in Nepal')

@push('css')
    <link href="{{ asset('frontend/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/lightbox2-2.11.3/dist/css/lightbox.min.css') }}">
@endpush

@section('content')



    @include('frontend.includes.modal')

    @if (setting() && setting()?->scrolling_news == 0)
        <section class="notice-section">
            <div class="annoncementBox">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <div class="spTitle">Anouncement</div>
                                <div class="spBody">
                                    <marquee behavior="scroll" direction="left">
                                        @foreach (scrolling() as $scrollings)
                                            {{ $loop->iteration }}. &nbsp; {{ $scrollings->description }} &nbsp;
                                        @endforeach
                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!--Modal Notic-->
    @foreach ($data['notices'] as $notice)
        <div class="modal fade" id="MoreInfo-{{ $notice->id }}" tabindex="-1" aria-labelledby="MoreInfoLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="MoreInfoLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if ($notice->image)
                                <div class="col-md-3">
                                    <div class="img__holder">
                                        @isset($notice->image)
                                            @php
                                                $extension = explode('.', $notice->image)[1];
                                            @endphp
                                        @endisset
                                        @isset($notice->image)
                                            @if ($extension == 'pdf')
                                                <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                    <img src="{{ asset('pdf-img.png') }}" alt="" class="img-fluid">
                                                </a>
                                            @elseif($extension == 'docx' || $extension == 'doc')
                                                <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                    <img src="{{ asset('word-img.png') }}" alt="" class="img-fluid">
                                                </a>
                                            @elseif($extension == 'xls' || $extension == 'xlsx')
                                                <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                    <img src="{{ asset('excel-img.png') }}" alt="" class="img-fluid">
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $notice->image) }}" alt=""
                                                        class="img-fluid">
                                                </a>
                                            @endif
                                        @endisset
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="text__holder">
                                        <h4>{{ $notice->title }}</h4>
                                        <p> {!! $notice->description !!}</p>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="text__holder">
                                        <h4>{{ $notice->title }}</h4>
                                        <p> {!! $notice->description !!}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!--Modal News & Events-->
    @foreach ($data['news_events'] as $news)
        <div class="modal fade" id="news-info-{{ $news->id }}" tabindex="-1" aria-labelledby="MoreInfoLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="MoreInfoLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if ($news->image)
                                <div class="col-md-3">
                                    <div class="img__holder">
                                        @isset($news->image)
                                            @php
                                                $extension = explode('.', $news->image)[1];
                                            @endphp
                                        @endisset
                                        @isset($news->image)
                                            @if ($extension == 'pdf')
                                                <a href="{{ asset('storage/' . $news->image) }}" target="_blank">
                                                    <img src="{{ asset('pdf-img.png') }}" alt="" class="img-fluid">
                                                </a>
                                            @elseif($extension == 'docx' || $extension == 'doc')
                                                <a href="{{ asset('storage/' . $news->image) }}" target="_blank">
                                                    <img src="{{ asset('word-img.png') }}" alt="" class="img-fluid">
                                                </a>
                                            @elseif($extension == 'xls' || $extension == 'xlsx')
                                                <a href="{{ asset('storage/' . $news->image) }}" target="_blank">
                                                    <img src="{{ asset('excel-img.png') }}" alt="" class="img-fluid">
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/' . $news->image) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $news->image) }}" alt=""
                                                        class="img-fluid">
                                                </a>
                                            @endif
                                        @endisset
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="text__holder">
                                        <h4>{{ $news->title }}</h4>
                                        <p> {!! $news->description !!}</p>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="text__holder">
                                        <h4>{{ $news->title }}</h4>
                                        <p> {!! $news->description !!}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!--End Modal News & Events-->
    
    @if (setting() && setting()?->about_design == 0)
        <section class="homepage-content-wrapper mx-auto">
            {{-- About Section --}}
            @if (!is_null($data['about_page']))
                <div class="about-section mx-auto">
                    <div class="container">
                        <div class="row align-items-start g-4 g-md-5">
                            <div class="col-12 col-md-6 col-lg-4 col-xs-12 col-sm-12">
                                <div class="about-img">
                                    <img src="{{ asset('storage/' . $data['about_page']->image) }}" width="100%"
                                        height="100%" alt="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-8 col-xs-12 col-sm-12">
                                <div class="about-desc">
                                    <div class="info__text-wrapper mb-3">
                                        <h2 class="title-label">{{ $data['about_page']->name ?? '' }}</h2>
                                    </div>

                                    <div class="main__decription mb-5" style="text-align: justify">

                                        <p> {!! Str::limit(strip_tags($data['about_page']->description, '<b><i>'), 550) !!}</p>
                                    </div>
                                    <a href="{{ route('frontend.about_single') }}" class="btn btn-hoverable2"
                                        target="_blank">
                                        Read More <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @else
            @endif
        </section>
        {{-- {{ asset('frontend/assets/img/bg.png') } --}}
    @elseif(setting() && setting()?->about_design == 1)
        @if (!is_null($data['about_page']))
            <div class="informartion section-padding"
                style="background-image: url('{{ asset('storage/' . setting()->background_image) }}'); background-repeat: no-repeat; background-size: cover; background-position: center; background-attachment: fixed;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-12">
                            <div class="aboutus__image">
                                <div class="about__image-two">
                                    @if ($data['about_page']->image)
                                        <img src="{{ asset('storage/' . $data['about_page']->image) }}" alt=""
                                            width="100%" height="100%">
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="aboutus__description wow fadeInUp" data-wow-delay="0.6s"
                                style="visibility: visible; -webkit-animation-delay: 0.6s; -moz-animation-delay: 0.6s; animation-delay: 0.6s;">
                                <!-- <div class="top__small">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span> Since 2020 </span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div> -->
                                <div class="info__text-wrapper">
                                    <h2>
                                        <span class="typing">{{ $data['about_page']->name ?? '' }}</span>
                                    </h2>
                                </div>
                                <div class="moto mb-3">
                                    @isset($data['about_page']->designation)
                                        “{{ $data['about_page']->designation ?? '' }}”
                                    @endisset

                                </div>
                                <!-- <div class="info__text-wrapper">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h2>School Name </h2>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->

                                <div class="main__decription mb-5">
                                    <p> {!! Str::limit(strip_tags($data['about_page']->description, '<b><i>'), 550) !!}</p>
                                </div>
                                <a href="{{ route('frontend.about_single') }}" class="btn btn-hoverable"
                                    target="_blank">
                                    <span>Read More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="informartion section-padding"
                style="background-image: url('{{ asset('frontend/assets/img/bg.png') }}'); background-repeat: no-repeat; background-size: cover; background-position: center; background-attachment: fixed;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-12">
                            <div class="aboutus__image">
                                <div class="about__image-two">
                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}" alt="" width="100%"
                                        height="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="aboutus__description wow fadeInUp" data-wow-delay="0.6s"
                                style="visibility: visible; -webkit-animation-delay: 0.6s; -moz-animation-delay: 0.6s; animation-delay: 0.6s;">
                                <!-- <div class="top__small">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span> Since 2020 </span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div> -->
                                <div class="info__text-wrapper">
                                    <h2>
                                        <span class="typing">About Us</span>
                                    </h2>
                                </div>
                                <div class="moto mb-3">
                                    “We are what we repeatedly do. Excellence, then, is not an act, but a habit”-
                                    Aristotle.”
                                </div>
                                <!-- <div class="info__text-wrapper">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h2>School Name </h2>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->

                                <div class="main__decription mb-5">
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed tempora vel
                                        perspiciatis quia veritatis voluptas necessitatibus aspernatur, maiores
                                        blanditiis architecto. Illum aperiam commodi hic adipisci iure nemo veritatis
                                        placeat dolorem. Optio veritatis atque laudantium iste in laborum deleniti,
                                        quaerat rerum natus, laboriosam est. Minima atque incidunt in tempora excepturi
                                        rerum? </p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro soluta commodi,
                                        error repudiandae ab aspernatur, sit veritatis possimus voluptate, ut libero
                                        dicta repellat fugit quisquam voluptatibus. Necessitatibus ipsa dignissimos
                                        tenetur quia! Consectetur a excepturi molestias culpa voluptatum nisi doloribus
                                        nihil fugit distinctio, sunt quidem assumenda facilis animi hic delectus.
                                        Ratione blanditiis eius eligendi enim ipsa asperiores, iste perferendis ducimus?
                                    </p>
                                </div>
                                <a href="about-us.html" class="btn btn-hoverable">
                                    <span>Read More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
    @endif


    @if (setting() && setting()?->management_team == 0)
        <div class="msg__wrapper py-4">
            <div class="container">
                <div class="row py-5">
                    <div class="info__text-wrapper text-center mb-5">
                        <h2> {{ $data['message']->title ?? '' }}</h2>
                    </div>
                    @forelse ($data['messages'] as $message)
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mx-auto">
                            <div class="about__items">
                                <div class="img__holder">
                                    @if ($message->image)
                                        <img src="{{ asset('storage/' . $message->image) }}" width="100%"
                                            height="100%" alt="{{ $message->name }}">
                                    @else
                                        <img src="{{ asset('no-image.png') }}" width="100%" height="100%"
                                            alt="">
                                    @endif
                                </div>
                                <div class="text__holder text-center p-2">
                                    <h4>{{ $message->name }}</h4>
                                    <h6>{{ $message->designation }}</h6>
                                    {{-- <a href="#" class="btn btn-hoverable" data-bs-toggle="modal"
                                        data-bs-target="#MoreInfo-{{ $message->id }}">
                                        <span>Read More</span>
                                    </a> --}}
                                    <a href="{{ route('frontend.message', $message->slug) }}" class="btn btn-hoverable2"
                                        target="_blank">Read
                                        More
                                        ></a>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @elseif (setting() && setting()?->management_team == 1)
        <div class="msg__wrapper py-4">
            <div class="container">
                <div class="row py-5">
                    <div class="info__text-wrapper text-center mb-5">
                        <h2> {{ $data['message']->title ?? '' }}</h2>
                    </div>
                    @forelse ($data['messages'] as $message)
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mx-auto">
                            <a href="#" target="_blank">
                            </a>
                            <div class="message-item"><a href="#" target="_blank">
                                    <div class="img__holder">
                                        <img src="{{ asset('storage/' . $message->image) }}" width="100%"
                                            height="100%" alt="">
                                    </div>
                                </a>
                                <div class="text__holder"><a href="#" target="_blank">
                                        <h6>{{ $message->name }}</h6>
                                        <span>{{ $message->designation }}</span><br />
                                        {{-- <p> {!! Str::limit(strip_tags($message->description), 60) !!}.</p> --}}
                                        <a href="{{ route('frontend.message', $message->slug) }}" target="_blank">Read
                                            More
                                            ></a>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @else
    @endif


    @if (news() && news()?->status == 0){

        <div class="news-and-events__section section-margin">
            <div class="container">
                <div class="row">
                    @if ($data['news_events']->isNotEmpty())
                        <div
                            class="col-lg-{{ setting()?->notice_board == 0 ? '9' : '12' }} col-md-12 col-sm-12 mb-0 text-center">
                            <div class="">
                                <div class="info__text-wrapper text-center">
                                    <h2> {{ $data['news_event']->title ?? '' }}</h2>
                                    @isset($data['news_event']->sub_title)
                                        <p>{{ $data['news_event']->sub_title ?? '' }}</p>
                                    @endisset
                                </div>

                                <a href="{{ route('frontend.news_events') }}" target="_blank" class="float-end mb-3">All
                                    Events
                                    <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="event__wrapper">
                                <div class="swiper newSlider">
                                    <div class="swiper-wrapper">
                                        @foreach ($data['news_events'] as $news)
                                            <div class="swiper-slide">

                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#news-info-{{ $news->id }}">
                                                    <div class="event-item">
                                                        <div class="event-image">
                                                            @isset($news->image)
                                                                <img src="{{ asset('storage/' . $news->image) }}"
                                                                    alt="{{ $news->title }}">
                                                            @endisset

                                                        </div>
                                                        <div class="date">
                                                            <span>{{ $news->created_at->format('Y-m-d') }}</span>
                                                        </div>
                                                        <div class="event-details">
                                                            <h6>{!! Str::limit(strip_tags($news->description), 50) !!}</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- <div class="col-lg-9 col-md-12 col-sm-12 mb-4">
                        <div class="news-top__header d-flex justify-content-between flex-wrap mb-4">
                            <h2>News & Events</h2>
                            <a href="News-event.html">All Events <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="event__wrapper">
                            <div class="swiper newSlider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @endif

                    @if (setting()?->notice_board == 0)
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <div class="right-notice  wow fadeInUp" data-wow-delay="0.1s"
                                style="visibility: visible; -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Notice Board</h5>
                                        <hr>
                                        <ul id="style-7">
                                            @forelse ($data['notices'] as $notice)
                                                <li>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#MoreInfo-{{ $notice->id }}">
                                                        <p class="fw-bold">{{ $notice->title }}</p>
                                                        <p>{!! Str::limit(strip_tags($notice->description), 100) !!}</p>
                                                        <span><i class="fa-solid fa-calendar-days"></i>
                                                            {{ $notice->created_at->format('Y-m-d') }}</span>
                                                    </a>
                                                </li>
                                            @empty
                                            @endforelse

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="right-notice  wow fadeInUp" data-wow-delay="0.1s"
                            style="visibility: visible; -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Notice Board</h5>
                                    <hr>
                                    <ul id="style-7">
                                        <li>
                                            <a href="#">
                                                <!-- <i class="fa-solid fa-circle-dot"></i> -->
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Cupiditate
                                                    mollitia quibusdam autem maxime assumenda.</p>
                                                <span><i class="fa-solid fa-calendar-days"></i> 2022-02-29</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Cupiditate
                                                    mollitia quibusdam autem maxime assumenda.</p>
                                                <span><i class="fa-solid fa-calendar-days"></i> 2022-02-29</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Cupiditate
                                                    mollitia quibusdam autem maxime assumenda.</p>
                                                <span><i class="fa-solid fa-calendar-days"></i> 2022-02-29</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Cupiditate
                                                    mollitia quibusdam autem maxime assumenda.</p>
                                                <span><i class="fa-solid fa-calendar-days"></i> 2022-02-29</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @endif

                </div>
            </div>
        </div>
        }
    @else
    @endif

    @if (album() && album()->status == 0)

        @if ($data['videos']->isNotEmpty())
            <section id="video__album-section" class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="info__text-wrapper mb-3 text-center">
                            <h2> {{ $data['video']->title ?? '' }}</h2>
                            @isset($data['video']->video_link)
                                <p>{{ $data['video']->video_link ?? '' }}</p>
                            @endisset
                        </div>
                        @foreach ($data['videos'] as $video)
                            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mb-3">
                                <div class="video-item wow fadeInLeft" data-wow-delay="0.1s"
                                    style="visibility: visible; -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;">
                                    <iframe width="100%" height="250" src="{{ $video->video_link }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                    <div class="video__title text-center">
                                        <h6>{{ $video->title }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif
    @else
    @endif


    @if (album() && album()->status == 0)
        @if (setting()?->gallery_design == 1)
            {{-- Single Gallery View --}}
            <div class="gallery-section pb-5 ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="top__header wow fadeInUp" data-wow-delay="0.1s">
                                <div class="info__text-wrapper mb-4 text-center">
                                    <h2>{{ $data['album']->title ?? '' }}</h2>
                                    @isset($data['album']->sub_title)
                                        <p>{{ $data['album']->sub_title ?? '' }}</p>
                                    @endisset
                                </div>
                            </div>

                            <div class="gg-box wow fadeInUp" data-wow-delay="0.2s">
                                @forelse ($data['galleries'] as $gallery)
                                    <div class="gg-element">
                                        <a class="example-image-link" href="{{ image_path($gallery->url) }}"
                                            data-lightbox="example-set">
                                            <img src="{{ image_path($gallery->url) }}" alt="Gallery Image">
                                        </a>
                                    </div>
                                @empty
                                    <h4 class="text-center">No gallery images available.</h4>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @elseif (setting()?->gallery_design == 0)
            {{-- Album View --}}
            <section class="album-section">
                <div class="container">
                    <div class="top__header text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="info__text-wrapper text-center mb-4">
                            <h2>{{ $data['album']->title ?? '' }}</h2>
                            @isset($data['album']->sub_title)
                                <p>{{ $data['album']->sub_title ?? '' }}</p>
                            @endisset
                        </div>
                    </div>

                    <div class="album__image-section">
                        <div class="row">
                            @forelse ($data['albums'] as $album)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                                    <a href="{{ route('frontend.photo_album_gallery', $album->slug) }}">
                                        <div class="album__item wow fadeInLeft" data-wow-delay="0.1s">
                                            <div class="overlay"></div>
                                            <div class="album-img__holder">
                                                @if ($album->images->count() > 0)
                                                    <img src="{{ image_path($album->images->first()->url) }}"
                                                        width="100%" height="100%" alt="{{ $album->title }}">
                                                @else
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}" width="100%"
                                                        height="100%" alt="Default Image">
                                                @endif
                                            </div>
                                            <div class="album__title text-center">
                                                <h5>{{ $album->title }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <h4 class="text-center">No albums available.</h4>
                            @endforelse
                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $data['albums']->links() }}
                    </div>
                </div>
            </section>
        @endif
    @else
    @endif



    <!-- Testimonial Start -->
    @if ($data['testimonials']->isNotEmpty())
        <div class="container mt-5 py-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wow fadeIn" data-wow-delay=".3s">
                        {{-- <h5 class="text-primary">{{ $data['testimonial']->title ?? '' }}</h5> --}}
                        {{-- <h1>{{ $data['testimonial']->sub_title ?? '' }}!</h1> --}}
                        <div class="info__text-wrapper text-center mb-4">
                            <h2>{{ $data['testimonial']->title ?? '' }}</h2>
                            @isset($data['testimonial']->sub_title)
                                <p>{{ $data['testimonial']->sub_title ?? '' }}</p>
                            @endisset
                        </div>

                    </div>
                    <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay=".5s">

                        @foreach ($data['testimonials'] as $testimonial)
                            <div class="testimonial-item border p-4">
                                <div class="d-flex align-items-center">

                                    @if ($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt=""
                                            class="img-thumbnail">
                                    @else
                                        <img src="{{ asset('no-image.png') }}" alt="" class="img-thumbnail">
                                    @endif

                                    <div class="ms-4">
                                        <h5 class="text-secondary">{{ $testimonial->title }}</h5>
                                        <p class="m-0 pb-3">{{ $testimonial->designation }} <br />
                                            {{ $testimonial->company }}</p>
                                    </div>
                                </div>
                                <div class="border-top mt-4 pt-3">
                                    <p class="mb-0">
                                        {!! Str::limit(strip_tags($testimonial->description), 305) !!}

                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    @endif

    <!-- Testimonial End -->

    @if (setting()?->show_hide_google_map == 0 && setting()?->google_map)
        <div class="map-section">
            {!! setting()?->google_map !!}
        </div>
    @endif




@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('frontend/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        // Testimonial carousel
        $(document).ready(function() {
            $(".testimonial-carousel").owlCarousel({
                autoplay: true,
                smartSpeed: 1500,
                center: true,
                dots: true,
                loop: true,
                margin: 20,
                nav: true,
                navText: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
        })
    </script>

    <script type="text/javascript">
        $(window).on('load', function() {
            $('.myModal').modal('show');
        });
    </script>
    <script type="text/javascript" src="{{ asset('frontend/assets/lightbox2-2.11.3/dist/js/lightbox.min.js') }}"></script>
@endpush
