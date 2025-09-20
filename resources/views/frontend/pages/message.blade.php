@extends('frontend.layouts.master')

@section('title')
    Messages
@endsection

@section('content')
    @if (isset($data['page']->image))
        <div class="top__header-wrappper" style="background-image: url('{{ asset('storage/' . $data['page']->image) }}');">
            <div class="overlay">
                <section>
                    <div class="container text-light shadow-text">
                        <h1>{{ $data['message']->title ?? '' }}</h1>
                    </div>
                </section>
            </div>
        </div>
    @else
        <div class="top__header-wrappper" style="background-image: url('{{ asset('frontend/assets/img/banner.jpg') }}');">
            <div class="overlay">
                <section>
                    <div class="container text-light shadow-text">
                        <h1>Messages</h1>
                    </div>
                </section>
            </div>
        </div>
    @endif
    <section class="message-section section-padding">
        <div class="container">
            <div class="message-img">
                @if (isset($data['message']->image))
                    <img src="{{ asset('storage/' . $data['message']->image) }}" alt="">
                @else
                    <img src="{{ asset('no-image.png') }}" alt="">
                @endif
            </div>
            <div>
                <div class="message-wrapper">

                    {!! $data['message']->description ?? '' !!}

                    <h5>{{ $data['message']->name ?? '' }}</h5>
                    <h5>{{ $data['message']->designation ?? '' }}</h5>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
