@extends('backend.layouts.master')

@section('title')
    Download | Dashboard
@endsection

@section('sub_title', $panel ?? '');

@section('content')
    <div class="pagetitle">
        <h1>Dashboard
            @if (isset($base_route))
                {{-- @if (Route::is('setting.index')) --}}
                @if (Route::has($base_route . 'index'))
                    <button class="btn btn-default float-end m-1">
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input menu-hide bg-{{ $data['menu']?->status == 0 ? 'success' : 'danger' }}"
                                data-id="{{ $data['menu']?->id ?? '' }}" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked" {{ $data['menu']?->status == 0 ? 'checked' : '' }}>
                            <i class="bi bi-menu-button"></i>
                            <span id="status-info"
                                class="{{ $data['menu']?->status == 0 ? 'text-success' : 'text-danger' }}">{{ $data['menu']?->status == 0 ? 'Menu is visible' : 'Menu is hidden' }}
                            </span>
                        </div>
                    </button>

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

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="title" class="form-control title" value=""
                                        id="floatingName" placeholder="Title Name">
                                    <label for="floatingName">Title</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" name="rank" class="form-control rank" value=""
                                        id="floatingName" placeholder="Subtitle Name">
                                    <label for="floatingName">Rank</label>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 image">
                                <label for="formFile" class="form-label">Cover Image</label>
                                <div class="form-group d-flex justify-content-between">

                                    <input name="cover_image" class="form-control file-input custom-file-input"
                                        type="file" id="formFile">

                                    <div class="image">
                                        <img src="" alt="" class="previewImage" height="50px">
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 image">
                                <label for="formFile" class="form-label">Download File</label>
                                <div class="form-group d-flex justify-content-between">

                                    <input name="image" class="form-control file-input custom-file-input" type="file"
                                        id="formFile">

                                    <div class="image">
                                        <img src="" alt="" class="previewImage" height="50px">
                                    </div>

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
    @foreach ($data['posts'] as $post)
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


                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="title" class="form-control title"
                                            value="{{ $post->title }}" id="floatingName" placeholder="Title">
                                        <label for="floatingName">Title</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="rank" class="form-control rank"
                                            value="{{ $post->rank }}" id="floatingName" placeholder="Rank">
                                        <label for="floatingName">Rank</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 image">
                                    <label for="formFile" class="form-label">Cover Image</label>
                                    <div class="form-group d-flex justify-content-between">

                                        <input name="cover_image" class="form-control file-input custom-file-input"
                                            type="file" id="formFile">

                                        <div class="image">
                                            @isset($post->cover_image)
                                                @php
                                                    $extension = explode('.', $post->cover_image)[1];
                                                @endphp
                                            @endisset
                                            @isset($post->cover_image)
                                                @if ($extension == 'pdf')
                                                    <a href="{{ asset('storage/' . $post->cover_image) }}" target="_blank">
                                                        <img src="{{ asset('pdf-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'docx' || $extension == 'doc')
                                                    <a href="{{ asset('storage/' . $post->cover_image) }}" target="_blank">
                                                        <img src="{{ asset('word-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'xls' || $extension == 'xlsx')
                                                    <a href="{{ asset('storage/' . $post->cover_image) }}" target="_blank">
                                                        <img src="{{ asset('excel-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $post->cover_image) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $post->cover_image) }}"
                                                            alt="" class="previewImage" height="40px"
                                                            height="40">
                                                    </a>
                                                @endif
                                            @endisset

                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 image">
                                    <label for="formFile" class="form-label">Download File</label>
                                    <div class="form-group d-flex justify-content-between">

                                        <input name="image" class="form-control file-input custom-file-input"
                                            type="file" id="formFile">

                                        <div class="image">
                                            @isset($post->image)
                                                @php
                                                    $extension = explode('.', $post->image)[1];
                                                @endphp
                                            @endisset
                                            @isset($post->image)
                                                @if ($extension == 'pdf')
                                                    <a href="{{ asset('storage/' . $post->image) }}" target="_blank">
                                                        <img src="{{ asset('pdf-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'docx' || $extension == 'doc')
                                                    <a href="{{ asset('storage/' . $post->image) }}" target="_blank">
                                                        <img src="{{ asset('word-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'xls' || $extension == 'xlsx')
                                                    <a href="{{ asset('storage/' . $post->image) }}" target="_blank">
                                                        <img src="{{ asset('excel-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $post->image) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                                            class="previewImage" height="40px" height="40">
                                                    </a>
                                                @endif
                                            @endisset

                                        </div>

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
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
                {{-- <h5 class="card-title">{{ $panel ?? '' }} <span>| List</span></h5> --}}

                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">

                    <div class="datatable-container mt-2">
                        <table class="table table-borderless datatable datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 5%;"><button
                                            class="datatable-sorter">#</button></th>
                                    <th data-sortable="true" style="width: 25%;"><button
                                            class="datatable-sorter">Name</button></th>
                                    <th data-sortable="true" style="width: 25%;"><button class="datatable-sorter">Cover
                                            Image</button></th>
                                    <th data-sortable="true" style="width: 25%;"><button
                                            class="datatable-sorter">Download File</button></th>
                                    <th data-sortable="true" style="width: 25%;"><button
                                            class="datatable-sorter">Rank</button></th>
                                    <th data-sortable="true" style="width: 5%"><button
                                            class="datatable-sorter">Status</button></th>
                                    <th data-sortable="true" style="width: 20%"><button
                                            class="datatable-sorter">Action</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['posts'] as $download)
                                    <tr data-index="0">
                                        <td> {{ $loop->iteration }} </td>
                                        <td>
                                            <small> {{ $download->title }} </small>
                                        </td>

                                        <td>
                                            @isset($download->cover_image)
                                                @php
                                                    $extension = explode('.', $download->cover_image)[1];
                                                @endphp
                                            @endisset
                                            @isset($download->cover_image)
                                                @if ($extension == 'pdf')
                                                    <a href="{{ asset('storage/' . $download->cover_image) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('pdf-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'docx' || $extension == 'doc')
                                                    <a href="{{ asset('storage/' . $download->cover_image) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('word-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'xls' || $extension == 'xlsx')
                                                    <a href="{{ asset('storage/' . $download->cover_image) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('excel-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $download->cover_image) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $download->cover_image) }}"
                                                            alt="" class="previewImage" height="40px"
                                                            height="40">
                                                    </a>
                                                @endif
                                            @endisset


                                        </td>

                                        <td>
                                            @isset($download->image)
                                                @php
                                                    $extension = explode('.', $download->image)[1];
                                                @endphp
                                            @endisset
                                            @isset($download->image)
                                                @if ($extension == 'pdf')
                                                    <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                        <img src="{{ asset('pdf-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'docx' || $extension == 'doc')
                                                    <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                        <img src="{{ asset('word-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'xls' || $extension == 'xlsx')
                                                    <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                        <img src="{{ asset('excel-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $download->image) }}" alt=""
                                                            class="previewImage" height="40px" height="40">
                                                    </a>
                                                @endif
                                            @endisset


                                        </td>
                                        <td><small>{{ $download->rank }}</small></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input check-uncheck"
                                                    data-id="{{ $download->id }}" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $download->status == '0' ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewPost-{{ $download->id }}">
                                                    <i class="bi bi-eye-fill fs-5 p-2 text-success"></i></a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editPost-{{ $download->id }}">
                                                    <i class="bi bi-pencil-square fs-5 p-2"></i></a>

                                                <form action="{{ route($base_route . 'destroy', $download->id) }}"
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
        </div>

        {{-- Post View  --}}
        @foreach ($data['posts'] as $download)
            <div class="modal fade" id="viewPost-{{ $download->id }}" tabindex="-1" aria-labelledby="viewPostLabel"
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
                                        value="{{ $download->title ?? '' }}">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-lable">Download File</label>
                                <div class="col-sm-6">
                                    @isset($download->image)
                                        @php
                                            $extension = explode('.', $download->image)[1];
                                        @endphp
                                    @endisset
                                    @isset($download->image)
                                        @if ($extension == 'pdf')
                                            <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                <img src="{{ asset('pdf-img.png') }}" alt="" class="previewImage"
                                                    width="40px" height="40">
                                            </a>
                                        @elseif($extension == 'docx')
                                            <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                <img src="{{ asset('word-img.png') }}" alt="" class="previewImage"
                                                    width="40px" height="40">
                                            </a>
                                        @elseif($extension == 'xls' || $extension == 'xlsx')
                                            <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                <img src="{{ asset('excel-img.png') }}" alt="" class="previewImage"
                                                    width="40px" height="40">
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/' . $download->image) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $download->image) }}" alt=""
                                                    class="previewImage" height="40px" height="40">
                                            </a>
                                        @endif
                                    @endisset

                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Rank</label>
                                <div class="col-sm-6">
                                    <small>{{ $download->rank ?? '' }}</small>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $download->createdBy?->name ?? '' }}</small>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $download->createdBy?->name ?? '' }}</small>
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

    <script>
        $(document).ready(function() {
            $('.check-uncheck').click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('download.status') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        // toastr.success(res.success_message);
                        successAlert(res.success_message)
                    }
                })
            });


            $(document).on('click', '.menu-hide', function() {
                let btn = $(this);
                let id = btn.data('id');

                $.ajax({
                    url: "{{ route('download.status_menu') }}",
                    method: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        successAlert(res.success_message);

                        let status = $('#status-info'); // target the span

                        if (res.status_update == 0) {
                            // Button styles
                            btn.removeClass('bg-danger text-danger')
                                .addClass('bg-success text-success');

                            // Status span styles + text
                            status.removeClass('text-danger').addClass('text-success').text(
                                'Menu is visible');

                        } else if (res.status_update == 1) {
                            // Button styles
                            btn.removeClass('bg-success text-success')
                                .addClass('bg-danger text-danger');

                            // Status span styles + text
                            status.removeClass('text-success')
                                .addClass('text-danger')
                                .text('Menu is hidden');
                        }
                    },
                    error: function(xhr) {
                        errorAlert("Something went wrong!");
                        console.error(xhr.responseText);
                    }
                });
            });


        });
    </script>
@endpush
