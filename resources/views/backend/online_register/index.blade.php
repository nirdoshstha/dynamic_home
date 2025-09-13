@extends('backend.layouts.master')

@section('title')
    Online Register| Dashboard
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('sub_title', $panel ?? '');

@section('content')
    <div class="pagetitle">
        <h1>Dashboard </h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">@yield('sub_title')</li>

            </ol>

        </nav>

    </div><!-- End Page Title -->



    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
                {{-- <h5 class="card-title">{{ $panel ?? '' }} <span>| List</span></h5> --}}

                <div class="">
                    <table class="table table-borderless" id="datatable">
                        <thead>
                            <tr>
                                <th>#</button></th>
                                <th>Image</button></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Grade</th>
                                <th>C.Grade</button></th>
                                <th>Gender</button></th>
                                <th>Action</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['students'] as $student)
                                <tr data-index="0">
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <div class="image">
                                            @isset($student->image)
                                                <img src="{{asset('storage/'.$student->image) }}" alt="" class="previewImage" width="40px" height="40px">
                                            @else
                                                <img src="{{ asset('no-image.png') }}" alt="" class="previewImage" width="40px" height="40px">
                                            @endisset

                                        </div>
                                    </td>
                                    <td>
                                        <small> {{ $student->name }} </small>
                                    </td>
                                    <td>
                                        <small> {{ $student->email }} </small>
                                    </td>
                                    <td>
                                        <small> {{ $student->phone }} </small>
                                    </td>
                                    <td>
                                        <small> {{ $student->grade }} </small>
                                    </td>
                                    <td>
                                        <small> {{ $student->current_grade }} </small>
                                    </td>
                                    <td><small>{{ $student->gender }}</small></td>



                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#viewPost-{{$student->id}}">
                                                <i class="bi bi-eye-fill fs-5 p-2 text-success"></i></a>

                                            <form action="{{ route($base_route . 'destroy', $student->id) }}"
                                                method="POST" class="main_form" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#">
                                                    <i
                                                        class="bi bi-x-circle-fill fs-5 p-2 text-danger delete-confirm"></i></a>
                                            </form>
                                        </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- Post View  --}}
        @foreach ($data['students'] as $student)
            <div class="modal fade" id="viewPost-{{$student->id}}" tabindex="-1" aria-labelledby="viewPostLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">


                        <div class="modal-body">

                                <div class="container">
                                    <div class="form-card">
                                        <div class="card">
                                            <div class="card-body p-5">
                                                <form action="" method="POST" enctype="multipart/form-data" class="main_form">
                                                    @csrf
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                        <div class="school__details text-center mb-4">
                                                            <h2 class="mb-0"> {{setting()->school_name ?? ''}}</h2>
                                                            <p class="mb-0">{{setting()->address ?? ''}}</p>
                                                            <p class="mb-0"> {{setting()->email ?? ''}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 input-image">
                                                        <div class="photo-upload">
                                                            <div class="img-holder form-group d-flex justify-content-center mb-1">
                                                                @if($student->image)
                                                                <img src="{{asset('storage/'.$student->image)}}" class="input__image-holder" alt=""
                                                                    width="100%" height="100%">
                                                                    @else
                                                                    <img src="{{asset('no-image.png')}}" class="input__image-holder" alt=""
                                                                    width="100%" height="100%">
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                    <div class="form-header mb-2">
                                                        <span>STUDENT'S INFORMATION</span>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="text-form" class="form-label mb-0">Name of the Applicant (Full Name) </label>
                                                        <input type="text" name="name" value="{{$student->name ?? ''}}" class="form-control" id="text-form"
                                                            aria-describedby="emailHelp" readonly>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="select-form1" class="form-label mb-0">Applied for Grade </label>

                                                                <input type="text" class="form-control" name="current_grade" value="{{$student->grade ?? ''}}"
                                                                id="text-form1" aria-describedby="emailHelp" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form1" class="form-label mb-0">Current Grade </label>
                                                                <input type="text" class="form-control" name="current_grade" value="{{$student->current_grade ?? ''}}"
                                                                    id="text-form1" aria-describedby="emailHelp" readonly>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-4">
                                                            <div class="mb-2">
                                                                <label for="select-form2" class="form-label mb-0">Gender:</label>
                                                                <input type="text" class="form-control"  value="{{$student->gender ?? ''}}"
                                                                    id="text-form1" aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-2">
                                                                <label for="select-form2" class="form-label mb-0">Nationality:</label>
                                                                <input type="text" class="form-control"  value="{{$student->nationality ?? ''}}"
                                                                    id="text-form1" aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-2">
                                                                <label for="text-form3" class="form-label mb-0">Email:</label>
                                                                <input type="email" value="{{$student->email ?? ''}}" class="form-control" id="text-form3"
                                                                    aria-describedby="emailHelp" name="email" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-4">
                                                            <div class="mb-2">
                                                                <label for="date-form1" class="form-label mb-0">Date of birth(BS):</label>
                                                                <div class="icon-Wrapper">
                                                                    <input class="form-control" name="dob_bs" type="text"
                                                                    id="nepali-datepicker" value="{{$student->dob_bs ?? ''}}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-2">
                                                                <label for="date-form2" class="form-label mb-0">Date of birth(AD):</label>
                                                                <input type="date" class="form-control" name="dob_ad" value="{{$student->dob_ad ?? ''}}"
                                                                    id="date-form2" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-2">
                                                                <label for="text-form3" class="form-label mb-0">Age:</label>
                                                                <input type="text" class="form-control" id="text-form5" name="age" value="{{$student->age ?? ''}}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form6" class="form-label mb-0">Address </label>
                                                                <input type="text" name="address" value="{{$student->address ?? ''}}" class="form-control" id="text-form6"
                                                                    aria-describedby="emailHelp" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form7" class="form-label mb-0">Phone </label>
                                                                <input type="text" name="phone" value="{{$student->phone ?? ''}}" class="form-control" id="text-form7"
                                                                    aria-describedby="emailHelp" readonly>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-header mb-2">
                                                        <span>FATHER'S INFORMATION</span>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form8" class="form-label mb-0">Father's Name </label>
                                                                <input type="text" name="father_name" value="{{$student->father_name ?? ''}}" class="form-control" id="text-form8"
                                                                    aria-describedby="emailHelp" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form9" class="form-label mb-0">Mobile No.:</label>
                                                                <input type="text" name="father_mobile" value="{{$student->father_mobile ?? ''}}" class="form-control"
                                                                    id="text-form9" aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form10" class="form-label mb-0">Email:</label>
                                                                <input type="email" name="father_email" value="{{$student->father_email ?? ''}}" class="form-control" id="text-form11"
                                                                    aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form12" class="form-label mb-0">Occupation:</label>
                                                                <input type="text" name="father_occupation" value="{{$student->father_occupation ?? ''}}" class="form-control"
                                                                    id="text-form12" aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-header mb-2">
                                                        <span>MOTHER'S INFORMATION</span>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form13" class="form-label mb-0">Mother's Name </label>
                                                                <input name="mother_name" type="text" value="{{$student->mother_name ?? ''}}" class="form-control" id="text-form13"
                                                                    aria-describedby="emailHelp" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form14" class="form-label mb-0">Mobile No.:</label>
                                                                <input name="mother_mobile" type="text" value="{{$student->mother_mobile ?? ''}}" class="form-control"
                                                                    id="text-form14" aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form15" class="form-label mb-0">Email:</label>
                                                                <input name="mother_email" type="email" value="{{$student->mother_email ?? ''}}" class="form-control" id="text-form15"
                                                                    aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form16" class="form-label mb-0">Occupation:</label>
                                                                <input name="mother_occupation" type="text" value="{{$student->mother_occupation ?? ''}}" class="form-control"
                                                                    id="text-form16" aria-describedby="emailHelp" readonly>
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
                                                                <input name="guardian" type="text" value="{{$student->guardian ?? ''}}"  class="form-control"
                                                                    id="text-form17" aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form18" class="form-label mb-0">Mobile No.:</label>
                                                                <input name="guardian_mobile" type="text" value="{{$student->guardian_mobile ?? ''}}" class="form-control"
                                                                    id="text-form18" aria-describedby="emailHelp" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="text-form19" class="form-label mb-0">Email:</label>
                                                                <input name="guardian_email" type="email" value="{{$student->guardian_email ?? ''}}" class="form-control" id="text-form19"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-2">
                                                                <label for="select-form3" class="form-label mb-0">Occupation:</label>
                                                                 <input type="text" class="form-control" name="guardian_occupation" value="{{$student->guardian_occupation ?? ''}}">
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
                                                                <input name="previous_school_name" type="text" value="{{$student->previous_school_name ?? ''}}" class="form-control"
                                                                    id="text-form20" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-2">
                                                                <label for="text-form21" class="form-label mb-0">Address:</label>
                                                                <input name="previous_school_address" type="text" value="{{$student->previous_school_address ?? ''}}" class="form-control" id="text-form21"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-2">
                                                                <label for="text-form22" class="form-label mb-0">Grade:</label>
                                                                <input name="previous_school_grade" type="text" value="{{$student->previous_school_grade ?? ''}}" class="form-control" id="text-form22"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                                                                placeholder="Write your query(If any)" rows="3">{{$student->description ?? ''}}</textarea>
                                                        </div>

                                                    </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach


    </div>
@endsection

@push('js')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/general.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
    new DataTable('#datatable');
    </script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#lnkPrint').click(function () {
            window.print();
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.viewPrint').click(function () {
            window.print();
        });
    });
</script>

@endpush
