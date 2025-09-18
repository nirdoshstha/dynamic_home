@extends('frontend.layouts.master')

@section('title')
    About Us
@endsection

@section('seo_keyword')
@endsection

@section('seo_description')
@endsection


@section('content')

    @if (isset($data['about_page']))
        <div class="top__header-wrappper"
            style="background-image: url('{{ asset('storage/' . $data['about_page']->image) }}');">
            <div class="overlay">
                <section id="subheader-title">
                    <div class="container">
                        <h1>{{ $data['about_page']->title ?? '' }}</h1>
                    </div>
                </section>
            </div>
        </div>
    @else
        <div class="top__header-wrappper" style="background-image: url('assets/img/banner.jpg');">
            <div class="overlay">
                <section id="subheader-title">
                    <div class="container">
                        <h1>{{ $data['about_page']->title ?? '' }}</h1>
                    </div>
                </section>
            </div>
        </div>
    @endif

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
    @elseif(setting() && setting()?->about_design == 1)
        @if (!is_null($data['about_page']))
            <div class="informartion section-padding"
                style="background: linear-gradient(rgba(136, 180, 78, 0.527), rgba(136, 180, 78, 0.516)),
            url('{{ asset('storage/' . setting()->background_image) }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;">
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
                                    <p> {!! $data['about_page']->description ?? '' !!}</p>
                                </div>
                                <a href="{{ route('frontend.about_single') }}" class="btn btn-hoverable" target="_blank">
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
@endsection

@push('js')
@endpush
