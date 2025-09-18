@if (setting() && setting()?->testimonial_design == 0)

    <!-- 1 Testimonial Start -->
    <section id="team-section" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wow fadeIn" data-wow-delay=".3s">
                        <div class="info__text-wrapper text-center mb-4">
                            <h2>{{ $data['testimonial']->title ?? '' }}</h2>
                            @isset($data['testimonial']->sub_title)
                                <p>{{ $data['testimonial']->sub_title ?? '' }}</p>
                            @endisset
                        </div>

                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 mb-4">
                    <div class="right__team-slider">
                        <div class="swiper-initialized swiper-horizontal swiper-backface-hidden">
                            <div class="" id="swiper-wrapper-40f5683dc38dce8f" aria-live="off">
                                <div class="event__wrapper">
                                    <div class="swiper testimonialSwiper">
                                        <div class="swiper-wrapper">
                                            @forelse ($data['testimonials'] as $testimonial)
                                                <div class="swiper-slide">
                                                    <div class="swiper-slide swiper-slide" role="group"
                                                        aria-label="1 / 3" style="width: 303px; margin-right: 20px;"
                                                        data-swiper-slide-index="0">
                                                        <div class="swiper__holder">
                                                            <div class="swiper__img">
                                                                @if ($testimonial->image)
                                                                    <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                                        alt="{{ $testimonial->title }}">
                                                                @else
                                                                    <img src="{{ asset('no-image.png') }}"
                                                                        alt="{{ $testimonial->title }}">
                                                                @endif
                                                            </div>

                                                            <div class="slider-desc">
                                                                <h5 class="text-center">{{ $testimonial->title }}</h5>
                                                                <span
                                                                    class="text-center">{{ $testimonial->designation }}</span>
                                                                <span
                                                                    class="text-center">{{ $testimonial->company }}</span>
                                                                <div
                                                                    style="height: 110px; overflow: hidden; text-align: justify;font-size: 12px;">
                                                                    <p>{!! Str::limit($testimonial->description, 220) !!}</p>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 1Testimonial End -->
@elseif(setting() && setting()?->testimonial_design == 1)
    <!-- 2 Testimonial Start -->
    @if ($data['testimonials']->isNotEmpty())
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wow fadeIn" data-wow-delay=".3s">
                        <div class="info__text-wrapper text-center mb-4">
                            <h2>{{ $data['testimonial']->title ?? '' }}</h2>
                            @isset($data['testimonial']->sub_title)
                                <p>{{ $data['testimonial']->sub_title ?? '' }}</p>
                            @endisset
                        </div>

                    </div>
                    <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay=".5s">

                        @forelse ($data['testimonials'] as $testimonial)
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
                                <div class="border-top p-2">
                                    <p class="mb-0">
                                        {!! Str::limit(strip_tags($testimonial->description), 180) !!}

                                    </p>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Testimonial End -->
@else
@endif
