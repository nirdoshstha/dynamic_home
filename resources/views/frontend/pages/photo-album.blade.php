@extends('frontend.layouts.master')

@section('title')
    Photo Album
@endsection

@section('content')
    @if (album() && album()->status == 0)
        @if (isset($data['page']))
            <div class="top__header-wrappper" style="background-image: url('{{ asset('storage/' . $data['page']->image) }}');">
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
        <section class="album-section section-padding">
            <div class="container">
                <div class="album__image-section">
                    <div class="row">
                        @foreach ($data['albums'] as $album)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                                <a href="{{ route('frontend.photo_album_gallery', $album->slug) }}">
                                    <div class="album__item wow fadeInLeft" data-wow-delay="0.1s"
                                        style="visibility: visible; -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;">
                                        <div class="overlay">
                                        </div>
                                        <div class="album-img__holder">
                                            @if (isset($album))
                                                @foreach ($album->images as $image)
                                                    <img src="{{ image_path($image->url) }}" width="100%" height="100%"
                                                        alt="">
                                                @endforeach
                                            @else
                                                <img src="{{ asset('frontend/assets/img/info.jpg') }}" width="100%"
                                                    height="100%" alt="">
                                            @endif

                                        </div>
                                        <div class="album__title text-center">
                                            <h5>{{ $album->title }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- pagination start  -->
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {{ $data['albums']->links() }}

                        </ul>
                    </nav>
                </div>
                <!-- pagination end -->
            </div>
        </section>
    @else
    @endif
@endsection

@push('js')
@endpush
