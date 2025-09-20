@extends('frontend.layouts.master')

@section('title')
    Video Gallery
@endsection

@section('content')
    @if (@isset($data['page']))
        <div class="top__header-wrappper" style="background-image: url('{{ asset('storage/' . $data['page']->image) }}');">
            <div class="overlay">
                <section>
                    <div class="container text-light shadow-text">
                        <h1>{{ $data['page']->title ?? '' }}</h1>
                    </div>
                </section>
            </div>
        </div>
    @else
        <div class="top__header-wrappper" style="background-image: url('assets/img/banner.jpg');">
            <div class="overlay">
                <section>
                    <div class="container text-light shadow-text">
                        <h1>Videos</h1>
                    </div>
                </section>
            </div>
        </div>
    @endif

    <section id="video__album-section" class="section-padding">
        <div class="container">
            <div class="video__container">
                <div class="row">
                    @foreach ($data['video'] as $video)
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
            <!-- pagination start  -->
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $data['video']->links() }}
                    </ul>
                </nav>
            </div>
            <!-- pagination end -->
        </div>
    </section>
@endsection

@push('js')
@endpush
