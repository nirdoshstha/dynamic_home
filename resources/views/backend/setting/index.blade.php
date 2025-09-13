@extends('backend.layouts.master')

@section('title')
    Setting
@endsection

@section('sub_title', $panel ?? '')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($base_route . 'index') }}">Home</a></li>
                <li class="breadcrumb-item active">@yield('sub_title')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">

        <div class="col-xl-12">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">


                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                aria-selected="true" role="tab" tabindex="-1">Home Setting</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"
                                aria-selected="false" tabindex="-1" role="tab">Social Media</button>
                        </li>



                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade profile-edit active show pt-3" id="profile-edit" role="tabpanel">

                            <!-- Profile Edit Form -->
                            <div class="card">
                                <div class="card-body">

                                    <!-- Floating Labels Form -->
                                    @isset($setting)
                                        <form action="{{ route($base_route . 'update', $setting) }}" method="POST"
                                            enctype="multipart/form-data" id="main_form" class="row g-3 mt-3 main_form">
                                            @csrf
                                            @method('PUT')
                                        @else
                                            <form action="{{ route($base_route . 'store') }}" method="POST"
                                                enctype="multipart/form-data" id="main_form" class="row g-3 mt-3 main_form">
                                                @csrf
                                            @endisset


                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" name="slogan"
                                                        value="{{ isset($setting) ? $setting->slogan : '' }}"
                                                        class="form-control" id="floatingSlogan" placeholder="Slogan">
                                                    <span class="text-danger">{{ $errors->first('slogan') }}</span>

                                                    <label for="floatingSlogan">Slogan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" name="school_name"
                                                        value="{{ isset($setting) ? $setting->school_name : '' }}"
                                                        class="form-control" id="floatingschool_name"
                                                        placeholder="School Name">
                                                    <span class="text-danger">{{ $errors->first('school_name') }}</span>

                                                    <label for="floatingschool_name">School Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="color" name="primary_color"
                                                        value="{{ isset($setting) ? $setting->primary_color : '#007aff' }}"
                                                        class="form-control" id="floatingSlogan" placeholder="Slogan">

                                                    <label for="floatingSlogan"><span class="fw-bold">Top Navbar Color
                                                            ({{ $setting->primary_color ?? '' }}) </span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="color" name="secondary_color"
                                                        value="{{ isset($setting) ? $setting->secondary_color : '#007aff' }}"
                                                        class="form-control" id="floatingSlogan" placeholder="Slogan">
                                                    <label for="floatingSlogan"><span class="fw-bold">Footer Gradient
                                                            ({{ $setting->secondary_color ?? '' }}) </span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="color" name="navbar_color"
                                                        value="{{ isset($setting) ? $setting->navbar_color : '#007aff' }}"
                                                        class="form-control" id="floatingSlogan" placeholder="Navbar Color">
                                                    <label for="floatingSlogan"><span class="fw-bold">Navbar Color
                                                            ({{ $setting->navbar_color ?? '' }}) </span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="color" name="title_color"
                                                        value="{{ isset($setting) ? $setting->title_color : '#007aff' }}"
                                                        class="form-control" id="floatingSlogan" placeholder="Title Color">
                                                    <label for="floatingSlogan"><span class="fw-bold">Title Color
                                                            ({{ $setting->title_color ?? '' }}) </span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" name="address"
                                                        value="{{ isset($setting) ? $setting->address : '' }}"
                                                        class="form-control address" id="floatingAddress"
                                                        placeholder="Your Address">
                                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                                    <label for="floatingAddress">Address</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="email" name="email"
                                                        value="{{ isset($setting) ? $setting->email : '' }}"
                                                        class="form-control email" id="floatingEmail"
                                                        placeholder="Your Email">
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>

                                                    <label for="floatingEmail">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="text" name="phone"
                                                        value="{{ isset($setting) ? $setting->phone : '' }}"
                                                        class="form-control phone" id="floatingPhone"
                                                        placeholder="Your Phone">
                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>

                                                    <label for="floatingPhone">Phone</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="text" name="mobile"
                                                        value="{{ isset($setting) ? $setting->mobile : '' }}"
                                                        class="form-control" id="floatingMobile" placeholder="Mobile">
                                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                    <label for="floatingMobile">Mobile</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="text" name="viber"
                                                        value="{{ isset($setting) ? $setting->viber : '' }}"
                                                        class="form-control" id="floatingViber" placeholder="Viber">
                                                    <span class="text-danger">{{ $errors->first('viber') }}</span>
                                                    <label for="floatingViber">Viber</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="text" name="whatsapp"
                                                        value="{{ isset($setting) ? $setting->whatsapp : '' }}"
                                                        class="form-control" id="floatingWhatsapp"
                                                        placeholder="Whatsapp">
                                                    <span class="text-danger">{{ $errors->first('whatsapp') }}</span>
                                                    <label for="floatingWhatsapp">Whatsapp</label>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="logo" class="form-control"
                                                        id="floatingLogo" placeholder="Your Logo">
                                                    @if (isset($setting->logo))
                                                        <img src="{{ asset('storage/' . $setting->logo) }}"
                                                            width="100" height="40" class="img-thumbnail"
                                                            style="margin-left: 15px;">
                                                        <a href="{{ route('setting.delete_logo_image') }}">
                                                            <i class="bi bi-x-circle-fill fs-5 p-2 text-danger"></i>

                                                        </a>
                                                    @else
                                                        <img src="{{ asset('no-image.png') }}" width="60"
                                                            class="img-thumbnail" style="margin-left: 15px;">
                                                    @endif

                                                    <label for="floatingLogo">Logo</label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('logo') }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="fav_icon" class="form-control"
                                                        id="floatingFavicon" placeholder="Fab Icon">
                                                    @if (isset($setting->fav_icon))
                                                        <img src="{{ asset('storage/' . $setting->fav_icon) }}"
                                                            width="90" height="40" class="img-thumbnail"
                                                            style="margin-left: 15px;">
                                                    @else
                                                        <img src="{{ asset('no-image.png') }}" width="60"
                                                            class="img-thumbnail" style="margin-left: 15px;">
                                                    @endif

                                                    <label for="floatingFavicon">Fav Icon</label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('fav_icon') }}</span>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="brochure_image" class="form-control"
                                                        id="floatingLogo">
                                                    @if (isset($setting->brochure_image))
                                                        <img src="{{ asset('storage/' . $setting->brochure_image) }}"
                                                            width="50" height="40" class="img-thumbnail"
                                                            style="margin-left: 15px;">
                                                    @else
                                                        <img src="{{ asset('no-image.png') }}" width="50"
                                                            class="img-thumbnail" style="margin-left: 15px;">
                                                    @endif

                                                    <label for="floatingLogo">Brochure Cover</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="brochure" class="form-control"
                                                        id="floatingbrochure" placeholder="Your brochure">
                                                    @if (isset($setting->brochure))
                                                        @php
                                                            $extension = explode('.', $setting->brochure)[1];
                                                        @endphp
                                                    @endif
                                                    @if (isset($setting->brochure))
                                                        @if ($extension == 'pdf')
                                                            <a href="{{ asset('storage/' . $setting->brochure) }}"
                                                                download>
                                                                <img src="{{ asset('pdf-img.png') }}" width="50"
                                                                    height="40" class="img-thumbnail"
                                                                    style="margin-left: 15px;">
                                                            </a>
                                                        @elseif ($extension == 'docx' || $extension == 'doc')
                                                            <a href="{{ asset('storage/' . $setting->brochure) }}"
                                                                download>
                                                                <img src="{{ asset('word-img.png') }}" width="50"
                                                                    height="40" class="img-thumbnail"
                                                                    style="margin-left: 15px;">
                                                            </a>
                                                        @elseif ($extension == 'xls' || $extension == 'xlsx')
                                                            <a href="{{ asset('storage/' . $setting->brochure) }}"
                                                                download>
                                                                <img src="{{ asset('excel-img.png') }}" width="50"
                                                                    height="40" class="img-thumbnail"
                                                                    style="margin-left: 15px;">
                                                            </a>
                                                        @endif
                                                    @endif

                                                    <label for="floatingbrochure">Brochure</label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('brochure') }}</span>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <textarea class="form-control text-muted" name="google_map" placeholder="Google Map" id="floatingTextarea"
                                                        style="height: 80px;">{{ isset($setting) ? $setting->google_map : '' }}</textarea>
                                                    <span class="text-danger">{{ $errors->first('google_map') }}</span>
                                                    <label for="floatingTextarea">Google Map</label>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="d-flex justify-content-between mt-4">
                                                    <label for="floatingTextarea">Is Google map display on Home ?</label>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input show_hide_map"
                                                            data-id="{{ $setting->id }}" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked"
                                                            {{ $setting->show_hide_google_map == '0' ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6 py-3">
                                                <div class="d-flex justify-content-between">
                                                    <label for="floatingName">Is Gallery design on Home ?</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="gallery_design" id="inlineRadio2" value="0"
                                                            {{ $setting->gallery_design == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">Folderwise</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="gallery_design" id="inlineRadio1" value="1"
                                                            {{ $setting->gallery_design == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio1">Zigazag</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="gallery_design" id="inlineRadio1" value="2"
                                                            {{ $setting->gallery_design == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio1">Hide</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6 py-3">
                                                <div class="d-flex justify-content-between">
                                                    <label for="floatingTextarea">Is Scrolling News display on Home
                                                        ?</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="scrolling_news" id="inlineRadio2" value="0"
                                                            {{ $setting->scrolling_news == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio2">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="scrolling_news" id="inlineRadio1" value="1"
                                                            {{ $setting->scrolling_news == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio1">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6 py-3">
                                                <div class="d-flex justify-content-between">
                                                    <label for="floatingTextarea">Is Notice Board display on Home
                                                        ?</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="notice_board" id="inlineRadio2" value="0"
                                                            {{ $setting->notice_board == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio2">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="notice_board" id="inlineRadio1" value="1"
                                                            {{ $setting->notice_board == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio1">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6 py-3">
                                                <div class="d-flex justify-content-between">
                                                    <label for="floatingName">Management Team design on Home ?</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="management_team" id="inlineRadio2" value="0"
                                                            {{ $setting->management_team == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio2">Default</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="management_team" id="inlineRadio1" value="1"
                                                            {{ $setting->management_team == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="inlineRadio1">Standard</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="management_team" id="inlineRadio1" value="2"
                                                            {{ $setting->management_team == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio1">Hide</label>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="background_image" class="form-control"
                                                        id="floatingbackground_image" placeholder="Your Background image">
                                                    @if (isset($setting->background_image))
                                                        <img src="{{ asset('storage/' . $setting->background_image) }}"
                                                            width="100" height="40" class="img-thumbnail"
                                                            style="margin-left: 15px;">
                                                    @endif

                                                    <label for="floatingLogo">Background Image <span
                                                            class="text-danger">image: max 2mb</span></label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('logo') }}</span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="school_image" class="form-control"
                                                        id="floatingFavicon" placeholder="Fab Icon">
                                                    @if (isset($setting->school_image))
                                                        <img src="{{ asset('storage/' . $setting->school_image) }}"
                                                            width="100" height="40" class="img-thumbnail"
                                                            style="margin-left: 15px;">
                                                    @endif

                                                    <label for="floatingFavicon">School Image <span
                                                            class="text-danger">image: max 2mb</span></label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('school_image') }}</span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="college_image" class="form-control"
                                                        id="floatingschoolimage" placeholder="Your school image">
                                                    @if (isset($setting->college_image))
                                                        <img src="{{ asset('storage/' . $setting->college_image) }}"
                                                            width="100" height="40" class="img-thumbnail"
                                                            style="margin-left: 15px;">
                                                    @endif

                                                    <label for="floatingschoolimage">College Image <span
                                                            class="text-danger">image: max 2mb</span></label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('college_image') }}</span>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="popup_image" class="form-control"
                                                        id="floatingschoolimage" placeholder="Your school image">
                                                    @if (isset($setting->popup_image))
                                                        <img src="{{ asset('storage/' . $setting->popup_image) }}"
                                                            width="60" class="img-thumbnail"
                                                            style="margin-left: 15px;"> <a href="#">
                                                            <a href="{{ route('setting.delete_popup_image') }}">
                                                                <i class="bi bi-x-circle-fill fs-5 p-2 text-danger"></i>

                                                            </a>
                                                        @else
                                                            <img src="{{ asset('no-image.png') }}" width="60"
                                                                class="img-thumbnail" style="margin-left: 15px;">
                                                    @endif

                                                    <label for="floatingschoolimage">Pop Up Image <span
                                                            class="text-danger">image: max 2mb</span></label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('popup_image') }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating d-flex justify-content-between">
                                                    <input type="file" name="master_logo" class="form-control"
                                                        id="floatingschoolimage" placeholder="Your school image">
                                                    @if (isset($setting->master_logo))
                                                        <img src="{{ asset('storage/' . $setting->master_logo) }}"
                                                            width="60" class="img-thumbnail"
                                                            style="margin-left: 15px;"> <a href="#">
                                                            <a href="{{ route('setting.delete_master_logo') }}">
                                                                <i class="bi bi-x-circle-fill fs-5 p-2 text-danger"></i>

                                                            </a>
                                                        @else
                                                            <img src="{{ asset('no-image.png') }}" width="60"
                                                                class="img-thumbnail" style="margin-left: 15px;">
                                                    @endif

                                                    <label for="floatingschoolimage">Master Logo <span
                                                            class="text-danger">image: max 2mb</span></label>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" name="school_title"
                                                        value="{{ isset($setting) ? $setting->school_title : '' }}"
                                                        class="form-control" id="floatingschool_title"
                                                        placeholder="School Title">
                                                    <span class="text-danger">{{ $errors->first('school_title') }}</span>

                                                    <label for="floatingschool_title">School Title</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" name="college_title"
                                                        value="{{ isset($setting) ? $setting->college_title : '' }}"
                                                        class="form-control" id="floatingcollege_title"
                                                        placeholder="College Title">
                                                    <span class="text-danger">{{ $errors->first('college_title') }}</span>

                                                    <label for="floatingcollege_title">College Title</label>
                                                </div>
                                            </div>



                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-{{ isset($setting) ? 'success' : 'primary' }}">{{ isset($setting) ? 'Update' : 'Create' }}</button>
                                            </div>
                                        </form><!-- End floating Labels Form -->



                                </div>
                            </div><!-- End Profile Edit Form -->

                        </div>



                        <!-- Social Media Form -->
                        <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                            <!-- Settings Form -->
                            <form action="{{ route('setting.social_media') }}" method="POST"
                                enctype="multipart/form-data" class="main_form">
                                @csrf
                                <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-lg-12">
                                        <table class="table table-borderless" id="image_wrapper" style="border: 0px">
                                            <tbody>
                                                <tr>
                                                    <th class="bg-light" style="width: 20%"><label
                                                            class="form-label fw-bold">Name</label></th>
                                                    <th class="bg-light" style="width: 40%"><label
                                                            class="form-label fw-bold">Link</label></th>
                                                    <th class="bg-light" style="width: 24%"><label
                                                            class="form-label fw-bold">Icon</label></th>
                                                    <th class="bg-light" style="width: 8%"><label
                                                            class="form-label fw-bold">Rank</label></th>
                                                    <th class="bg-light" style="width: 8%">
                                                        <label class="form-label fw-bold">
                                                            <div>
                                                                <i class="bi bi-plus-circle-fill text-success fs-3"
                                                                    id="addMoreImage"></i>

                                                            </div>
                                                    </th>

                                                </tr>


                                                @foreach ($socials_media as $socialmedia)
                                                    <tr>
                                                        <input type="hidden" name="social_id[]"
                                                            value="{{ $socialmedia->id }}">
                                                        <td>
                                                            <input type="text" name="name[]"
                                                                class="form-control name[]"
                                                                value="{{ isset($socialmedia) ? $socialmedia->name : '' }}"
                                                                required>
                                                            <span
                                                                class="text-danger">{{ $errors->first('name[]') }}</span>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="link[]"
                                                                class="form-control link[]"
                                                                value="{{ isset($socialmedia) ? $socialmedia->link : '' }}"
                                                                required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="icon[]"
                                                                class="form-control icon[]"
                                                                value="{{ isset($socialmedia) ? $socialmedia->icon : '' }}"
                                                                placeholder="fa-brands fa-linkedin" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="rank[]"
                                                                class="form-control rank[]"
                                                                value="{{ isset($socialmedia) ? $socialmedia->rank : '' }}">
                                                        </td>
                                                        @isset($socialmedia)
                                                            <td class="d-flex justify-content-center">
                                                                <a href="javascript:void(0)" data-id="{{ $socialmedia->id }}"
                                                                    class="remove_social_media">
                                                                    <i class="bi bi-trash-fill text-danger fs-5"></i>
                                                                </a>
                                                            </td>
                                                        @endisset

                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    {{-- <td class="mx-auto">
                                                         <i class="bi bi-file-plus-fill text-success fs-4"
                                                             id="addMoreImage"></i>
                                                         <span class="px-1"></span>
                                                         <i class="bi bi-trash-fill text-danger fs-4 remove_image"></i>
                                                     </td> --}}

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End settings Form -->
                        </div><!-- End settings Form -->



                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>

    </div>
@endsection

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/general.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.show_hide_map').on('click', function() {

                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('setting.google_map_status') }}",
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        successAlert(resp.success_message)
                    },
                    error: function(err) {
                        error(resp.error_message)
                    }
                })
            })
        })
    </script>
    <script>
        var z = 1;
        $('#addMoreImage').click(function() {
            var max_fields = 5;
            if (z < max_fields) { //max input box allowed
                z++;
                $("#image_wrapper tr:last").before(`<tr>
                <td>
                    <input type="text" name="name[]" class="form-control" required>
                </td>
                <td>
                    <input type="text" name="link[]" class="form-control" required>
                </td>
                <td>
                    <input type="text" name="icon[]" class="form-control"  placeholder="fa-brands fa-linkedin" required>
                </td>
                <td>
                        <input type="text" name="rank[]" class="form-control" >
                    </td>
                <td class="d-flex justify-content-center">
                    <i class="bi bi-trash-fill text-danger fs-5 remove_image"></i>

                </td>
            </tr>
`);
            } else {
                alert('Maximum Images Limit is 5');
            }
        });

        $(document).on("click", ".remove_image", function() {
            if (z > 1) {
                z--;
                $(this).closest("tr").remove();
            } else {
                alert('Sorry you can\'t remove last row');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.remove_social_media').on('click', function(e) {
                e.preventDefault();
                let current = $(this);
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('social_media.destory') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        current.parents("tr").remove();
                        // toast(res.success_message);
                        toastr.success(res.success_message);
                    }
                });

            })
        })
    </script>
@endpush
