@extends('frontend.layouts.master')

@section('title')
    Online Form Register
@endsection

@push('css')
    <style>
        .input-group-prepend .input-group-text {
            background-color: #fff;
            border: none;
            /* Remove border */
        }
    </style>
    <link href="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css"
        rel="stylesheet" type="text/css" />

    <style>
        /* Hide calendar icon but working while click in date input */
        input[type='date']::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }


        .photo-upload .custom-file-label {
            background-color: #ff950a;
            color: #ffffff;
            padding: 7px;
            width: 9rem;
            border-radius: 5px;
        }

        .photo-upload .custom-file-label::after {
            display: none;
        }

        .photo-upload .img-holder {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            height: 100%;
            width: 100%;
        }

        .photo-upload .img-holder .input__image-holder {
            width: 9rem;
            height: 8rem;
            border-radius: 5px;
        }
    </style>
@endpush

@section('content')
    <section id="form-section" class="section-margin">
        <div class="container">
            <div class="form-card">
                <div class="card">
                    <div class="card-body p-5">
                        <form action="{{ route('frontend.online_register_store') }}" method="POST"
                            enctype="multipart/form-data" class="main_form" id="onlineForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="school__details text-center mb-4">
                                        <h2 class="mb-0"> {{ setting()->school_name ?? '' }}</h2>
                                        <p class="mb-0">{{ setting()->address ?? '' }}</p>
                                        <p class="mb-0"> {{ setting()->email ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 input-image">
                                    <div class="photo-upload">
                                        <div class="img-holder form-group d-flex justify-content-center mb-1">
                                            <img src="{{ asset('no-image.png') }}" class="input__image-holder"
                                                alt="" width="100%" height="100%">
                                        </div>
                                        <div class="text-center">
                                            <div class="btn-holder form-group mb-0">
                                                <div class="custom-file d-flex justify-content-center">
                                                    <input id="inputGroupFile02" type="file" name="image"
                                                        class="custom-file-input inputGroupFile02 d-none" id="customFile">
                                                    <label class="custom-file-label" for="inputGroupFile02">Choose
                                                        File</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p class="text-danger">Fields with (*) are compulsory.</p>

                            <div class="form-header mb-2">
                                <span>STUDENT'S INFORMATION</span>
                            </div>
                            <div class="mb-2">
                                <label for="text-form" class="form-label mb-0">Name of the Applicant (Full Name)
                                    <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    id="text-form" aria-describedby="emailHelp" required>
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="select-form1" class="form-label mb-0">Applied for Grade <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="select-form1" name="grade"
                                            value="{{ old('grade') }}" required>
                                            <option value="">--Please select Grade--</option>

                                            <option value="PG">PG</option>
                                            <option value="Nursery">Nursery</option>
                                            <option value="LKG">LKG</option>
                                            <option value="UKG">UKG</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                            <option value="5">Five</option>
                                            <option value="6">Six</option>
                                            <option value="7">Seven</option>
                                            <option value="8">Eight</option>
                                            <option value="9">Nine</option>

                                        </select>
                                        <span class="text-danger">
                                            @error('grade')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form1" class="form-label mb-0">Current Grade <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="current_grade"
                                            value="{{ old('current_grade') }}" id="text-form1" aria-describedby="emailHelp"
                                            required>
                                        <span class="text-danger">
                                            @error('current_grade')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="mb-2">
                                        <label for="select-form2" class="form-label mb-0">Gender:</label>
                                        <select name="gender" value="{{ old('gender') }}" class="form-select"
                                            id="select-form2" required>
                                            <option value="">--Please Select Gender--</option>
                                            <option value="male" class="bg-white">Male</option>
                                            <option value="female" class="bg-white">Female</option>
                                            <option value="other" class="bg-white">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-2">
                                        <label for="select-form2" class="form-label mb-0">Nationality:</label>
                                        <select name="nationality" value="{{ old('nationality') }}" class="form-select"
                                            id="select-form2">
                                            <option value="">--Please Select Nationality</option>
                                            <option value="Afghan/Afghani" class="bg-white">Afghan/Afghani</option>
                                            <option value="Bangladeshi" class="bg-white">Bangladeshi</option>
                                            <option value="Chinese" class="bg-white">Chinese</option>
                                            <option value="Indian" class="bg-white">Indian</option>
                                            <option value="Kazakh/Kazakhstani " class="bg-white">Kazakh/Kazakhstani
                                            </option>
                                            <option selected="" value="Nepali" class="bg-white">Nepali</option>
                                            <option value="Pakistani" class="bg-white">Pakistani</option>
                                            <option value="Sri Lankan" class="bg-white">Sri Lankan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-2">
                                        <label for="text-form3" class="form-label mb-0">Email:</label>
                                        <input type="email" value="{{ old('nationality') }}" class="form-control"
                                            id="text-form3" aria-describedby="emailHelp" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <label for="date-form2" class="form-label mb-0">Date of birth(BS):</label>
                                    <div class="input-group">
                                        <input class="form-control" name="dob_bs" type="text" id="nepali-datepicker"
                                            value="{{ old('dob_') }}">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="date-form2" class="form-label mb-0">Date of birth(BS):</label>
                                    <div class="input-group">
                                        <input class="form-control" name="dob_ad" type="date" id="date-form2"
                                            value="{{ old('dob_ad') }}">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-2">
                                        <label for="text-form3" class="form-label mb-0">Age:</label>
                                        <input type="text" class="form-control" id="text-form5" name="age"
                                            value="{{ old('age') }}" aria-describedby="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form6" class="form-label mb-0">Address <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="address" value="{{ old('address') }}"
                                            class="form-control" id="text-form6" aria-describedby="emailHelp" required>
                                        <span class="text-danger">
                                            @error('address')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form7" class="form-label mb-0">Phone <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                            class="form-control" id="text-form7" aria-describedby="emailHelp" required>
                                        <span class="text-danger">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-header mb-2">
                                <span>FATHER'S INFORMATION</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form8" class="form-label mb-0">Father's Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="father_name" value="{{ old('father_name') }}"
                                            class="form-control" id="text-form8" aria-describedby="emailHelp" required>
                                        <span class="text-danger">
                                            @error('father_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form9" class="form-label mb-0">Mobile No.:</label>
                                        <input type="text" name="father_mobile" value="{{ old('father_mobile') }}"
                                            class="form-control" id="text-form9" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form10" class="form-label mb-0">Email:</label>
                                        <input type="email" name="father_email" value="{{ old('father_email') }}"
                                            class="form-control" id="text-form11" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form12" class="form-label mb-0">Occupation:</label>
                                        <input type="text" name="father_occupation"
                                            value="{{ old('father_occupation') }}" class="form-control" id="text-form12"
                                            aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                            <div class="form-header mb-2">
                                <span>MOTHER'S INFORMATION</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form13" class="form-label mb-0">Mother's Name <span
                                                class="text-danger">*</span></label>
                                        <input name="mother_name" type="text" value="{{ old('mother_name') }}"
                                            class="form-control" id="text-form13" aria-describedby="emailHelp" required>
                                        <span class="text-danger">
                                            @error('mother_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form14" class="form-label mb-0">Mobile No.:</label>
                                        <input name="mother_mobile" type="text" value="{{ old('mother_mobile') }}"
                                            class="form-control" id="text-form14" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form15" class="form-label mb-0">Email:</label>
                                        <input name="mother_email" type="email" value="{{ old('mother_email') }}"
                                            class="form-control" id="text-form15" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form16" class="form-label mb-0">Occupation:</label>
                                        <input name="mother_occupation" type="text"
                                            value="{{ old('mother_occupation') }}" class="form-control" id="text-form16"
                                            aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                            <div class="form-header mb-2">
                                <span>LOCAL GUARDIAN'S INFORMATION</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form17" class="form-label mb-0">Local Guardian:</label>
                                        <input name="guardian" type="text" value="{{ old('guardian') }}"
                                            class="form-control" id="text-form17" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form18" class="form-label mb-0">Mobile No.:</label>
                                        <input name="guardian_mobile" type="text"
                                            value="{{ old('guardian_mobile') }}" class="form-control" id="text-form18"
                                            aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="text-form19" class="form-label mb-0">Email:</label>
                                        <input name="guardian_email" type="email" value="{{ old('guardian_email') }}"
                                            class="form-control" id="text-form19" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="select-form3" class="form-label mb-0">Occupation:</label>
                                        <input type="text" class="form-control" name="guardian_occupation"
                                            value="{{ old('guardian_occupation') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-header mb-2">
                                <span>PREVIOUS SCHOOL'S INFORMATION</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <div class="mb-2">
                                        <label for="text-form20" class="form-label mb-0">School Name:</label>
                                        <input name="previous_school_name" type="text"
                                            value="{{ old('previous_school_name') }}" class="form-control"
                                            id="text-form20" aria-describedby="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-2">
                                        <label for="text-form21" class="form-label mb-0">Address:</label>
                                        <input name="previous_school_address" type="text"
                                            value="{{ old('previous_school_address') }}" class="form-control"
                                            id="text-form21" aria-describedby="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-2">
                                        <label for="text-form22" class="form-label mb-0">Grade:</label>
                                        <input name="previous_school_grade" type="text"
                                            value="{{ old('previous_school_grade') }}" class="form-control"
                                            id="text-form22" aria-describedby="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                                        placeholder="Write your query(If any)" rows="3">{{ old('description') }}</textarea>
                                </div>

                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    
                                    <div class="form-group mt-2 mb-4 "> 

                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif


                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-end">
                                        <button class="btn btn-form px-4 py-2" type="submit">Apply
                                            Now</button>
                                        <button class="btn btn-reset px-4 py-2" type="reset">Reset
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        {{-- <button id="buttonTop" class="btn btn-top" title="Back to Top"><i class="fa-solid fa-caret-up"></i></button> --}}
    </section>
@endsection

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/general.js') }}"></script>
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js"
        type="text/javascript"></script>

    <script type="text/javascript">
        window.onload = function() {
            var mainInput = document.getElementById("nepali-datepicker");
            mainInput.nepaliDatePicker();
        };
    </script>

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

    <script>
        $('form').submit(function() {
            $(this).find('button[type=submit]').prop('disabled', true);
        });
    </script>
    <script>
        var loadFile3 = function(event) {
            var image = document.getElementById('placeholder_image3');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        $('.inputGroupFile02').on('change', function(e) {
            if (e.target.files.length) {
                // $(this).next('.custom-file-label').html(e.target.files[0].name);
                $(this).closest('.text-center').find('.file__name').html(e.target.files[0].name);

            }
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // $('.blah').attr('src', e.target.result);
                    var image = $(input).closest('.input-image').find('img');
                    // image.removeClass('input__image-holder');

                    image.attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script type="text/javascript">
        window.onload = function() {
            var mainInput = document.getElementById("nepali-datepicker");
            mainInput.nepaliDatePicker();
        };
    </script>
@endpush
