@extends('frontend.layouts.master')

@section('title')
    News And Events
@endsection

@section('content')

    @if (news() && news()->status == 0)
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
        <section class="news-and-events__section section-padding">
            <div class="container">
                <div class="events__wrapper">
                    @foreach ($data['news'] as $news)
                        @if ($loop->iteration % 2 == 0)
                            <div class="events__items">
                                <div class="row align-items-center">
                                    <div class="col-md-9 ps-5">
                                        <div class="event__text">
                                            <h5>{{ $news->title }}</h5>
                                            <span class="date">{{ $news->created_at->format('Y-m-d') }}</span>
                                            <p>{!! Str::limit($news->description, 200) !!}</p>
                                        </div>
                                        <a href="#" class="btn btn-hoverable" data-bs-toggle="modal"
                                            data-bs-target="#detailsModal-{{ $news->id }}">
                                            <span>View Details</span>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="img__holder">
                                            <img src="{{ asset('storage/' . $news->image) }}" width="100%" height="100%"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="events__items">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="img__holder">
                                            <img src="{{ asset('storage/' . $news->image) }}" width="100%" height="100%"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <div class="event__text">
                                            <h5>{{ $news->title }}</h5>
                                            <span class="date">{{ $news->created_at->format('Y-m-d') }}</span>
                                            <p>{!! Str::limit($news->description, 200) !!}</p>
                                        </div>
                                        <a href="#" class="btn btn-hoverable" data-bs-toggle="modal"
                                            data-bs-target="#detailsModal-{{ $news->id }}">
                                            <span>View Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {{ $data['news']->links() }}
                </div>

                <!-- Modal -->
                @foreach ($data['news'] as $news)
                    <div class="modal fade" id="detailsModal-{{ $news->id }}" tabindex="-1"
                        aria-labelledby="detailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="detailsModalLabel">{{ $news->title }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="img__holder">
                                        <img src="{{ asset('storage/' . $news->image) }}" width="100%" height="100%"
                                            alt="">
                                    </div>
                                    <div class="text__holder">
                                        <p> {!! $news->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- modal end -->
            </div>
        </section>
    @endif
@endsection

@push('js')
@endpush
