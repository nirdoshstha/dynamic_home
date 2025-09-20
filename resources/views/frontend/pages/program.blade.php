@extends('frontend.layouts.master')

@section('title')
    {{ $data['program']->title ?? '' }}
@endsection

@push('css')
@endpush

@section('content')
    @if (program() && program()?->status == 0)
        <section id="university-section">
            <div class="top__header-wrappper"
                style="background-image: url('{{ isset($data['program']) ? asset('storage/' . $data['program']->banner) : '/frontend/assets/images/unilogo.png' }}'); background-size: cover; height: 24rem; background-position: top;">
                <div class="overlay">
                </div>
                <section id="subheader-title">
                    <div class="container">
                        <h1>{{ $data['program']->title ?? '' }}</h1>
                    </div>
                </section>
            </div>
            <div class="container">
                <div class="row py-5">
                    <div class="col-lg-8 col-md-12">

                        <div class="uni-desc wow fadeInLeft" data-wow-delay="0.3s"
                            style="visibility: visible; -webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                            <p>{!! $data['program']->description ?? '' !!}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.3s"
                        style="visibility: visible; -webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                        @isset($data['program']->image)
                            <div class="side__img mb-3">
                                <a href="#">
                                    <img src="{{ asset('storage/' . $data['program']->image) }}" width="100%" height="100%"
                                        alt="">
                                </a>
                            </div>
                        @endisset

                        @isset($data['program']->courses)
                            {{-- //Show Courses Only --}}
                            <div class="side__course-wrapper">
                                <div class="slide__menu-bar mb-3">
                                    <div class="side__courses">
                                        <div class="title">
                                            <h4 class="mb-0">Courses</h4>
                                            <hr>
                                        </div>
                                        <span>{!! $data['program']->courses ?? '' !!}</span>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($data['program']->university)
                            {{-- University List --}}
                            <div class="side__course-wrapper">
                                <div class="slide__menu-bar mb-3">
                                    <div class="side__courses">
                                        <div class="title">
                                            <h4 class="mb-0">University/ Collage</h4>
                                            <hr>
                                        </div>
                                        <p>{!! $data['program']->university ?? '' !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endisset



                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection


@push('js')
@endpush
