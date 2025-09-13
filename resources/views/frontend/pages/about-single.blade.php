@extends('frontend.layouts.master')

@section('title')
About Us
@endsection

@section('seo_keyword')
@endsection

@section('seo_description')
@endsection


@section('content')
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
                            <div class="top__big-text">
                                <h3>
                                    <span class="typing">{{ $data['about']->name ?? '' }}</span>
                                </h3>
                            </div>
                            <div class="moto mb-3">
                                “{{ $data['about']->designation ?? '' }}”
                            </div>
                            <!-- <div class="top__big-text">
                                <h3>School Name </h3>
                            </div> -->

                            <div class="main__decription mb-5">
                                <p> {!! $data['about']->description ?? '' !!}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')

@endpush
