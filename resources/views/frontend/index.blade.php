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


    

    @foreach ($data['section_rank'] as $section)
        @include('frontend.pages.section.' . $section->name)
    @endforeach



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
