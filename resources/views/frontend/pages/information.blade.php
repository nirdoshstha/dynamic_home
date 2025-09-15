@extends('frontend.layouts.master')

@section('title')
    {{ $data['information']->title ?? '' }}
@endsection

@section('content')
    @if (information() && information()->status == 0)
        @if (isset($data['page']->image))
            <div class="top__header-wrappper"
                style="background-image: url('{{ asset('storage/' . $data['information']->image) }}');">
                <div class="overlay">
                    <section id="subheader-title">
                        <div class="container">
                            <h1>{{ $data['information']->title ?? '' }}</h1>
                        </div>
                    </section>
                </div>
            </div>
        @else
            <div class="top__header-wrappper" style="background-image: url('{{ asset('frontend/assets/img/banner.jpg') }}');">
                <div class="overlay">
                    <section id="subheader-title">
                        <div class="container">
                            <h1>{{ $data['information']->title ?? '' }}</h1>
                        </div>
                    </section>
                </div>
            </div>
        @endif

        <section class="information-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 mb-3">
                        <div class="sidebar">
                            <div class="sidebar__items">
                                <ul>
                                    @foreach (informations() as $information)
                                        <li
                                            class="side__links {{ Request::is('information/' . $information->slug) ? 'active' : '' }}">
                                            <a href="/information/{{ $information->slug }}">{{ $information->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="content__wrapper p-2">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="info__text-wrapper">
                                        <h2>{{ $data['information']->title ?? '' }}</h2>
                                        {!! $data['information']->description ?? '' !!}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="swiper infoSwiper">
                                        <div class="swiper-wrapper">
                                            @foreach ($data['information']->images as $slider)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset(image_path($slider->url)) }}"
                                                        alt="{{ $data['information']->title }}">
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection


@push('js')
    <script>
        var swiper = new Swiper(".infoSwiper", {
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    </script>
@endpush
