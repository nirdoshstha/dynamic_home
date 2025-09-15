@extends('frontend.layouts.master')

@section('title')
    Dowlnload
@endsection

@section('content')


    @if (downloadMenu() && downloadMenu()?->status == 0)
        {{-- @if ($data['downloads']->image)
        <div class="top__header-wrappper" style="background-image: url('{{ asset('storage/' . $data['alumni']->image) }}');">
            <div class="overlay">
                <section id="subheader-title">
                    <div class="container">
                        <h1>{{ $data['alumni']->title ?? '' }}</h1>
                    </div>
                </section>
            </div>
        </div>
    @else --}}
        <div class="top__header-wrappper" style="background-image: url('{{ asset('frontend/assets/img/banner.jpg') }}');">
            <div class="overlay">
                <section id="subheader-title">
                    <div class="container">
                        <h1>Download</h1>
                    </div>
                </section>
            </div>
        </div>
        {{-- @endif --}}


        <section class="aboutUs-section section-padding">
            <div class="container">
                <div class="aboutUs__wrapper">
                    <div class="top__text">
                        {{-- <p>{!! $data['alumni']->description !!}</p> --}}
                    </div>
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="row">
                                @foreach ($data['downloads'] as $download)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 ">
                                        <div class="about__items shadow-xl">
                                            <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                <div class="img__holder">
                                                    @if ($download->cover_image)
                                                        <img src="{{ asset('storage/' . $download->cover_image) }}"
                                                            width="100%" height="100%" alt="{{ $download->name }}">
                                                    @else
                                                        <img src="{{ asset('no-image.png') }}" width="100%" height="100%"
                                                            alt="">
                                                    @endif
                                                </div>
                                                <div class="text__holder text-center">
                                                    <h6>{{ $download->title }}</h6>

                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="pagination__wrapper d-flex justify-content-center">
                                    {{ $data['downloads']->links() }}
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($data['downloads'] as $download)
                    <div class="modal fade" id="MoreInfo-{{ $download->id }}" tabindex="-1" aria-labelledby="MoreInfoLabel"
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
                                                @if ($download->image)
                                                    <img src="{{ asset('storage/' . $download->image) }}" width="100%"
                                                        height="100%" alt="">
                                                @else
                                                    <img src="{{ asset('no-image.png') }}" width="100%" height="100%"
                                                        alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="text__holder">
                                                <h4>{{ $download->title }}</h4>
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
@endsection

@push('js')
@endpush
