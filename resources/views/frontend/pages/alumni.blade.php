@extends('frontend.layouts.master')

@section('title')
    Alumni
@endsection

@section('content')
    @if ($data['alumni']->image)
        <div class="top__header-wrappper" style="background-image: url('{{ asset('storage/' . $data['alumni']->image) }}');">
            <div class="overlay">
                <section>
                    <div class="container text-light shadow-text">
                        <h1>{{ $data['alumni']->title ?? '' }}</h1>
                    </div>
                </section>
            </div>
        </div>
    @else
        <div class="top__header-wrappper" style="background-image: url('{{ asset('frontend/assets/img/banner.jpg') }}');">
            <div class="overlay">
                <section>
                    <div class="container text-light shadow-text">
                        <h1>Alumni</h1>
                    </div>
                </section>
            </div>
        </div>
    @endif


    <section class="aboutUs-section section-padding">
        <div class="container">
            <div class="aboutUs__wrapper">
                <div class="top__text">
                    <p>{!! $data['alumni']->description !!}</p>
                </div>
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="row">
                            @foreach ($data['alumnies'] as $alumni)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 ">
                                    <div class="about__items shadow-xl">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#MoreInfo-{{ $alumni->id }}">
                                            <div class="img__holder">
                                                @if ($alumni->image)
                                                    <img src="{{ asset('storage/' . $alumni->image) }}" width="100%"
                                                        height="100%" alt="{{ $alumni->name }}">
                                                @else
                                                    <img src="{{ asset('no-image.png') }}" width="100%" height="100%"
                                                        alt="">
                                                @endif
                                            </div>
                                            <div class="text__holder text-center">
                                                <h4>{{ $alumni->title }}</h4>
                                                <h6>{{ $alumni->designation }}</h6>
                                                <h6>{{ $alumni->company }}</h6>


                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                            <div class="pagination__wrapper d-flex justify-content-center">
                                {{ $data['alumnies']->links() }}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            @foreach ($data['alumnies'] as $alumni)
                <div class="modal fade" id="MoreInfo-{{ $alumni->id }}" tabindex="-1" aria-labelledby="MoreInfoLabel"
                    aria-hidden="true">
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
                                            @if ($alumni->image)
                                                <img src="{{ asset('storage/' . $alumni->image) }}" width="100%"
                                                    height="100%" alt="">
                                            @else
                                                <img src="{{ asset('no-image.png') }}" width="100%" height="100%"
                                                    alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="text__holder">
                                            <h4>{{ $alumni->title }}</h4>
                                            <h6>{{ $alumni->designation }}</h6>
                                            <p> {!! $alumni->description !!}</p>
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
@endsection

@push('js')
@endpush
