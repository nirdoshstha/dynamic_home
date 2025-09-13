@extends('frontend.layouts.master')

@section('title')
    Contact Us
@endsection

@section('content')
    @if (isset($data['contact']))
        )
        <div class="top__header-wrappper" style="background-image: url('{{ asset('storage/' . $data['contact']->image) }}');">
            <div class="overlay">
                <section id="subheader-title">
                    <div class="container">
                        <h1>{{ $data['contact']->name ?? '' }}</h1>
                    </div>
                </section>
            </div>
        </div>
    @else
        <div class="top__header-wrappper" style="background-image: url('{{ asset('frontend/assets/img/banner.jpg') }}');">
            <div class="overlay">
                <section id="subheader-title">
                    <div class="container">
                        <h1>Contact Us</h1>
                    </div>
                </section>
            </div>
        </div>
    @endif
    <section class="contact-section section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters mb-5">
                            <div class="col-lg-7 col-md-12">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Contact Us</h3>
                                    {{-- @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif --}}
                                    <form action="{{ route('frontend.send_message') }}" method="POST" class="contactForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="name">Full Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"
                                                        placeholder="Name" required>
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="email">Email Address</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}"
                                                        placeholder="Email" required>
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="subject">Subject</label>
                                                    <input type="text" class="form-control" name="subject" id="subject" value="{{old('subject')}}"
                                                        placeholder="Subject">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="#">Message</label>
                                                    <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message">{{old('message')}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="form-group mt-2 mb-4 ">
                                                    <div class="captcha d-flex justify-content-between">
                                                        <span>{!! captcha_img('math') !!}</span>
                                                        <p class="p-2"></p>
                                                        <button type="button" class="btn btn-danger" id="reload"
                                                            style="width: 100px; height:40px;">
                                                            &#x21bb;
                                                        </button>
                                                        <p class="p-2"></p>
                                                        <input type="text" name="captcha" class="form-control"
                                                            placeholder="Enter Captcha">

                                                    </div>
                                                    <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-hoverable"> <span>Send Message</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 d-flex align-items-stretch">
                                <div class="info-wrap w-100 p-lg-5 p-4">
                                    <h3 class="mb-4 mt-md-4">Contact us</h3>
                                    <div class="dbox w-100 d-flex align-items-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-map-marker"></span>
                                        </div>
                                        <div class="text ps-3">
                                            <p><span>Address:</span> {{ setting()->address ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="dbox w-100 d-flex align-items-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-phone"></span>
                                        </div>
                                        <div class="text ps-3">
                                            <p><span>Phone:</span> <a
                                                    href="tel://{{ setting()->phone ?? '' }}">{{ setting()->phone ?? '' }}</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="dbox w-100 d-flex align-items-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-phone"></span>
                                        </div>
                                        <div class="text ps-3">
                                            <p><span>Mobile:</span> <a
                                                    href="mailto:{{ setting()->mobile ?? '' }}">{{ setting()->mobile ?? '' }}</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="dbox w-100 d-flex align-items-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-paper-plane"></span>
                                        </div>
                                        <div class="text ps-3">
                                            <p><span>Email</span> <a href="#">{{ setting()->email ?? '' }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!is_null(setting()->google_map))
        <div class="map">
            {!! setting()->google_map !!}
        </div>
    @endif
@endsection

@push('js')
    <script src="{{ asset('backend/assets/js/general.js') }}"></script>

    <script>
        $('#reload').click(function() {

            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(res) {
                    $('.captcha span').html(res.captcha);
                }
            });
        });
    </script>
@endpush
