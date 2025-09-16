@extends('frontend.layouts.master')

@section('title')
    Photo Gallery
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/lightbox2-2.11.3/dist/css/lightbox.min.css') }}">
@endpush

@section('content')
    @if (album() && album()->status == 0)
        @if (isset($data['page']))
            <div class="top__header-wrappper"
                style="background-image: url('{{ asset('storage/' . $data['page']->image) }}');">
                <div class="overlay">
                    <section id="subheader-title">
                        <div class="container">
                            <h1>{{ $data['page']->title ?? '' }}</h1>
                        </div>
                    </section>
                </div>
            </div>
        @else
            <div class="top__header-wrappper" style="background-image: url('{{ asset('frontend/assets/img/banner.jpg') }}');">
                <div class="overlay">
                    <section id="subheader-title">
                        <div class="container">
                            <h1>{{ $data['page']->title ?? '' }}</h1>
                        </div>
                    </section>
                </div>
            </div>
        @endif
        <section class="photo__gallery-section section-padding">
            <div class="container">
                <div class="photo__gallery">
                    <div class="row">

                        @foreach ($data['album']->images->where('status', 0) as $image)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="gallery__image wow fadeInLeft" data-wow-delay="0.1s"
                                    style="visibility: visible; -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;">
                                    <a class="example-image-link" href="{{ image_path($image->url) }}"
                                        data-lightbox="example-set">
                                        <img src="{{ image_path($image->url) }}" width="100%" height="100%">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    @else
    @endif
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('frontend/assets/lightbox2-2.11.3/dist/js/lightbox.min.js') }}"></script>
@endpush
