@extends('frontend.layouts.master')

@section('title')
    About Us
@endsection

@section('content')

    @if (about() && about()?->status == 0)
        @if (isset($data['categories']->image))
            <div class="top__header-wrappper"
                style="background-image: url('{{ asset('storage/' . $data['categories']->image) }}');">
                <div class="overlay">
                    <section id="subheader-title">
                        <div class="container">
                            <h1>{{ $data['categories']->title ?? '' }}</h1>
                        </div>
                    </section>
                </div>
            </div>
        @else
            <div class="top__header-wrappper" style="background-image: url('{{ asset('frontend/assets/img/banner.jpg') }}');">
                <div class="overlay">
                    <section id="subheader-title">
                        <div class="container">
                            <h1>{{ $data['categories']->title ?? '' }}</h1>
                        </div>
                    </section>
                </div>
            </div>
        @endif

        @if (isset($data['categories']))
            @if ($data['categories']->design == 'grid')
                <section class="aboutUs-section section-padding">
                    <div class="container">
                        <div class="aboutUs__wrapper">
                            <div class="top__text">
                                <p>{!! $data['categories']->description !!}</p>
                            </div>
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        @foreach ($data['posts'] as $post)
                                            <div class="col-xl-3 col-lg-4 col-md-6">
                                                <div class="about__items">
                                                    <div class="img__holder">
                                                        @if ($post->image)
                                                            <img src="{{ asset('storage/' . $post->image) }}" width="100%"
                                                                height="100%" alt="{{ $post->name }}">
                                                        @else
                                                            <img src="{{ asset('no-image.png') }}" width="100%"
                                                                height="100%" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="text__holder text-center">
                                                        <h4>{{ $post->name }}</h4>
                                                        <h6>{{ $post->designation }}</h6>
                                                        <a href="#" class="btn btn-hoverable" data-bs-toggle="modal"
                                                            data-bs-target="#MoreInfo-{{ $post->id }}">
                                                            <span>Read More</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($data['posts'] as $post)
                            <div class="modal fade" id="MoreInfo-{{ $post->id }}" tabindex="-1"
                                aria-labelledby="MoreInfoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="MoreInfoLabel"></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="img__holder">
                                                        @if ($post->image)
                                                            <img src="{{ asset('storage/' . $post->image) }}"
                                                                width="100%" height="100%" alt="">
                                                        @else
                                                            <img src="{{ asset('no-image.png') }}" width="100%"
                                                                height="100%" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="text__holder">
                                                        <h4>{{ $post->name }}</h4>
                                                        <h6>{{ $post->designation }}</h6>
                                                        <p> {!! $post->description !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @elseif($data['categories']->design == 'long')
                <section class="aboutUs-section section-padding">
                    <div class="container">
                        <div class="aboutUs__wrapper">
                            @forelse ($data['posts'] as $post)
                                <div class="about__items">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <div class="img__holder">
                                                @if ($post->image)
                                                    <img src="{{ asset('storage/' . $post->image) }}" width="100%"
                                                        height="100%" alt="">
                                                @else
                                                    <img src="{{ asset('no-image.png') }}" width="100%" height="100%"
                                                        alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="text__holder">
                                                <h4>{{ $post->name }}</h4>
                                                <h6>{{ $post->designation }}</h6>
                                                {!! $post->description !!}
                                            </div>
                                            <a href="#" class="btn btn-hoverable" data-bs-toggle="modal"
                                                data-bs-target="#MoreInfo-{{ $post->id }}">
                                                <span>Read More</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="about__items">
                                    <div class="row align-items-center text-center">
                                        <h5 class="text-danger text-danger">No Data Found</h5>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                        @foreach ($data['posts'] as $post)
                            <div class="modal fade" id="MoreInfo-{{ $post->id }}" tabindex="-1"
                                aria-labelledby="MoreInfoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="MoreInfoLabel"></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="img__holder">
                                                        @if ($post->image)
                                                            <img src="{{ asset('storage/' . $post->image) }}"
                                                                width="100%" height="100%" alt="">
                                                        @else
                                                            <img src="{{ asset('no-image.png') }}" width="100%"
                                                                height="100%" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="text__holder">
                                                        <h4>{{ $post->name }}</h4>
                                                        <h6>{{ $post->designation }}</h6>
                                                        <p> {!! $post->description !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endif
    @endif

@endsection

@push('js')
@endpush
