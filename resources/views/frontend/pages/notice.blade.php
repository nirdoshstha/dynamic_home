@extends('frontend.layouts.master')

@section('title')
    Notice
@endsection

@section('content')
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
        <div class="top__header-wrappper" style="background-image: url('assets/img/banner.jpg');">
            <div class="overlay">
                <section id="subheader-title">
                    <div class="container">
                        <h1>{{ $data['page']->title ?? '' }}</h1>
                    </div>
                </section>
            </div>
        </div>
    @endif


    <section class="notice-section section-padding">
        <div class="container">
            <div class="accordion mb-3" id="accordionPanelsStayOpenExample">
                @foreach ($data['notice'] as $notice)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne-{{ $notice->id }}" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne-{{ $notice->id }}">
                                <div class="top__button d-flex justify-content-between w-100">
                                    <div class="left__wrapper">
                                        <i class="fa-solid fa-arrow-right"></i> <span>{{ $notice->title }}</span>
                                    </div>
                                    <div class="date">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span>Notice Date : {{ $notice->created_at->format('Y-m-d') }}</span>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne-{{ $notice->id }}" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
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
                                                            <img src="{{ asset('pdf-img.png') }}" alt=""
                                                                class="img-fluid">
                                                        </a>
                                                    @elseif($extension == 'docx' || $extension == 'doc')
                                                        <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                            <img src="{{ asset('word-img.png') }}" alt=""
                                                                class="img-fluid">
                                                        </a>
                                                    @elseif($extension == 'xls' || $extension == 'xlsx')
                                                        <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                            <img src="{{ asset('excel-img.png') }}" alt=""
                                                                class="img-fluid">
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
                @endforeach
            </div>
            {{ $data['notice']->links() }}
        </div>
    </section>
@endsection

@push('js')
@endpush
