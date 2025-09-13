@extends('backend.layouts.master')

@section('title')
    Alumni | Dashboard
@endsection

@section('sub_title', $panel ?? '');

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Dashboard
            @if (isset($base_route))
                {{-- @if (Route::is('setting.index')) --}}
                @if (Route::has($base_route . 'index'))
                    {{-- @if (request()->routeIs(['setting.*', 'profile.*', 'admin_create.*'])) --}}

                    <button type="button" class="btn btn-primary float-end m-1" data-bs-toggle="modal"
                        data-bs-target="#pageModal"><i class="bi bi-card-list me-1"></i>
                        {{ isset($data['page']) ? 'Edit' : 'Create' }} {{ $panel ?? '' }} Page</button>
                    <button type="button" class="btn btn-success m-1 float-end" data-bs-toggle="modal"
                        data-bs-target="#postModal"><i class="bi bi-plus-circle me-1"></i>
                        Post {{ $panel ?? '' }}</button>
                @else
                @endif
            @endif
        </h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($base_route . 'index') }}">Home</a></li>
                <li class="breadcrumb-item active">@yield('sub_title')</li>

            </ol>

        </nav>

    </div><!-- End Page Title -->

    <!-- Modal -->

    {{-- Page --}}
    <div class="modal fade" id="pageModal" tabindex="-1" aria-labelledby="pageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span>{{ isset($data['page']) ? 'Edit' : 'Create' }} {{ $panel ?? '' }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">


                        <!-- Floating Labels Form -->
                        @if (isset($data['page']))
                            <form action="{{ route('alumni_page.update', $data['page']) }}" method="POST"
                                enctype="multipart/form-data" class="row g-3 main_form">
                                @csrf
                                @method('PUT')
                            @else
                                <form action="{{ route($base_route . 'store') }}" method="POST"
                                    enctype="multipart/form-data" class="row g-3 main_form">
                                    @csrf
                        @endif
                        <input type="hidden" name="type" value="page">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="title" class="form-control title"
                                    value="{{ $data['page']->title ?? '' }}" id="floatingName" placeholder="Your Name">
                                <label for="floatingName">Title</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="sub_title" value="{{ $data['page']->sub_title ?? '' }}"
                                    class="form-control sub_title" id="floatingName" placeholder="Your Name">
                                <label for="floatingName">Sub Title</label>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-12 col-lg-12 image">
                            <label for="formFile" class="form-label">Banner</label>
                            <div class="form-group d-flex justify-content-between">

                                <input name="image" class="form-control file-input custom-file-input" type="file"
                                    id="formFile">

                                <div class="image">
                                    @isset($data['page']->image)
                                        <img src="{{ asset('storage/' . $data['page']->image) }}" alt=""
                                            class="previewImage" height="50px">
                                    @else
                                        <img src="{{ asset('no-image.png') }}" alt="" class="previewImage"
                                            height="50px">
                                    @endisset

                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="description" class="form-control description" placeholder="Address" id="editor"
                                    style="height: 100px;">{{ $data['page']->description ?? '' }}</textarea>
                                <label for="floatingTextarea">Description</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="seo_title" value="{{ $data['page']->seo_title ?? '' }}"
                                    class="form-control" id="floatingEmail" placeholder="Your Email">
                                <label for="floatingEmail">Seo Title</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="seo_keyword" value="{{ $data['page']->seo_keyword ?? '' }}"
                                    class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Seo Keyword</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea class="form-control" name="seo_description" placeholder="Address" id="floatingTextarea">{{ $data['page']->seo_description ?? '' }}</textarea>
                                <label for="floatingTextarea">Seo Description</label>
                            </div>
                        </div>

                        <div class="text-center">
                            @if (isset($data['page']))
                                <button type="submit" class="btn btn-success">Update</button>
                            @else
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            @endif

                        </div>
                        </form><!-- End floating Labels Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Post Add --}}
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Add {{ $panel }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="card-body">
                        <form action="{{ route($base_route . 'store') }}" method="POST" enctype="multipart/form-data"
                            id="main_form" class="row g-3 main_form">
                            @csrf
                            <input type="hidden" name="type" value="post">


                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="title" class="form-control title" value=""
                                        id="floatingName" placeholder="Name">
                                    <label for="floatingName">Name</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="designation" class="form-control" value=""
                                        id="floatingName" placeholder="Designation">
                                    <label for="floatingName">Designation</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="company" class="form-control company" value=""
                                        id="floatingName" placeholder="Company">
                                    <label for="floatingName">Company</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="faculty_year" class="form-control faculty_year"
                                        value="" id="floatingName" placeholder="Faculty Year">
                                    <label for="floatingName">Faculty & Year</label>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 image">
                                {{-- <label for="formFile" class="form-label">Image</label> --}}
                                <div class="form-group d-flex justify-content-between">

                                    <input name="image" class="form-control file-input custom-file-input"
                                        type="file" id="formFile">

                                    <div class="image">
                                        <img src="{{ asset('no-image.png') }}" alt="" class="previewImage"
                                            height="50px">
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">

                                    <textarea name="description" id="editor100" class="form-control description" rows="5" id="floatingTextarea"
                                        placeholder="Type Description" style="height:120px;"></textarea>
                                    {{-- <label for="floatingName">Description</label> --}}
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End floating Labels Form -->



                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- Post Edit --}}
    @foreach ($data['posts'] as $index => $post)
        <div class="modal fade" id="editPost-{{ $post->id }}" tabindex="-1" aria-labelledby="postModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>Edit {{ $panel }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="card-body">
                            <form action="{{ route($base_route . 'update', $post->id) }}" method="POST"
                                enctype="multipart/form-data" id="main_form" class="row g-3 main_form">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="type" value="post">


                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="title" class="form-control title"
                                            value="{{ $post->title }}" id="floatingName" placeholder="Name">
                                        <label for="floatingName">Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="designation" class="form-control designation"
                                            value="{{ $post->designation }}" id="floatingName"
                                            placeholder="Designation">
                                        <label for="floatingName">Designation</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="company" class="form-control company"
                                            value="{{ $post->company }}" id="floatingName" placeholder="Company">
                                        <label for="floatingName">Company</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="faculty_year" class="form-control faculty_year"
                                            value="{{ $post->faculty_year }}" id="floatingName"
                                            placeholder="Faculty Year">
                                        <label for="floatingName">Faculty Year</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 image">
                                    <label for="formFile" class="form-label">Image</label>
                                    <div class="form-group d-flex justify-content-between">

                                        <input name="image" class="form-control file-input custom-file-input"
                                            type="file" id="formFile">


                                        <div class="image">

                                            @if ($post->image)
                                                <a href="{{ asset('storage/' . $post->image) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                                        class="previewImage" height="40px" height="40">
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">

                                        <textarea name="description" id="editor{{ $index }}" class="form-control description" rows="5"
                                            id="floatingTextarea" placeholder="Type Description" style="height:120px;"> {!! $post->description !!} </textarea>

                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form><!-- End floating Labels Form -->



                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach


    <div class="col-12">
        <div class="card">

            <div class="card-body">


                <div class="">
                    {{-- <table class="table table-borderless datatable datatable-table">
                            <thead> --}}
                    <table class="display" id="myTable">
                        <thead>
                            <tr class="text-center">
                                <th style="width:5%">#</th>
                                <th style="width:20%">Name </th>
                                <th style="width:10%">Image </th>
                                <th style="width:15%">Designation </th>
                                <th style="width:15%">Company </th>
                                <th style="width:10%">Status </th>
                                <th style="width:25%">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['posts'] as $alumni)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <small> {{ $alumni->title }} </small>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $alumni->image) }}" class="img-thumbnail"
                                            width="50px;">
                                    </td>
                                    <td>
                                        {{ $alumni->designation }}
                                    </td>
                                    <td>{{ $alumni->company }}</td>


                                    <td>
                                        <div class="form-check form-switch text-center mx-auto">
                                            <input class="form-check-input check-uncheck mx-auto"
                                                data-id="{{ $alumni->id }}" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" {{ $alumni->status == '0' ? 'checked' : '' }}>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#viewPost-{{ $alumni->id }}">
                                                <i class="bi bi-eye-fill fs-5 p-2 text-success"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#editPost-{{ $alumni->id }}">
                                                <i class="bi bi-pencil-square fs-5 p-2"></i></a>

                                            <form action="{{ route($base_route . 'destroy', $alumni->id) }}"
                                                method="POST" class="main_form" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#user-20">
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
        @foreach ($data['posts'] as $alumni)
            <div class="modal fade" id="viewPost-{{ $alumni->id }}" tabindex="-1" aria-labelledby="viewPostLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span>View {{ $panel }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-1 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $alumni->title }}">
                                </div>
                            </div>


                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-6">
                                    <small>{{ $alumni->designation }}</small>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Company</label>
                                <div class="col-sm-6">
                                    <small>{{ $alumni->company }}</small>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Faculty & Year</label>
                                <div class="col-sm-6">
                                    <small>{{ $alumni->faculty_year }}</small>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <p>{!! $alumni->description !!}</p>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-2">

                                    @if ($alumni->image)
                                        <a href="{{ asset('storage/' . $alumni->image) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $alumni->image) }}" alt=""
                                                class="previewImage" width="80">
                                        </a>
                                    @endif

                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $alumni->createdBy?->name ?? '' }}</small>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $alumni->createdBy?->name ?? '' }}</small>
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


    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>

    <script>
        $(document).ready(function() {
            $('.check-uncheck').click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('alumni.status') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        // toastr.success(res.success_message);
                        successAlert(res.success_message)
                    }
                })
            });

        });
    </script>
@endpush
