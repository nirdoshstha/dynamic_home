@extends('backend.layouts.master')

@section('title')
    Notice | Dashboard
@endsection

@section('sub_title', $panel ?? '');

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
                            <form action="{{ route('notice_page.update', $data['page']) }}" method="POST"
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
                                        id="floatingName" placeholder="Title Name">
                                    <label for="floatingName">Title</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="sub_title" class="form-control sub_title" value=""
                                        id="floatingName" placeholder="Subtitle Name">
                                    <label for="floatingName">Sub Title</label>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 image">
                                <label for="formFile" class="form-label">Image</label>
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
                                    <label for="floatingName">Description</label>
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
                                            value="{{ $post->title }}" id="floatingName" placeholder="Title Name">
                                        <label for="floatingName">Title</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="sub_title" class="form-control sub_title"
                                            value="{{ $post->sub_title }}" id="floatingName"
                                            placeholder="Subtitle Name">
                                        <label for="floatingName">Sub Title</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 image">
                                    <label for="formFile" class="form-label">Image</label>
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
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
                {{-- <h5 class="card-title">{{ $panel ?? '' }} <span>| List</span></h5> --}}

                <div class="">

                    <div class="datatable-container">
                        {{-- <table class="table table-borderless datatable datatable-table">
                            <thead> --}}
                        <table class="table table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name </th>
                                    <th>Description </th>
                                    <th>Status </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['posts'] as $notice)
                                    <tr data-index="0">
                                        <td> {{ $loop->iteration }} </td>
                                        <td>
                                            <small> {{ $notice->title }} </small>
                                        </td>
                                        <td>
                                            {!! Str::limit(strip_tags($notice->description), 110) !!}
                                        </td>


                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input check-uncheck"
                                                    data-id="{{ $notice->id }}" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $notice->status == '0' ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewPost-{{ $notice->id }}">
                                                    <i class="bi bi-eye-fill fs-5 p-2 text-success"></i></a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editPost-{{ $notice->id }}">
                                                    <i class="bi bi-pencil-square fs-5 p-2"></i></a>

                                                <form action="{{ route($base_route . 'destroy', $notice->id) }}"
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
        @foreach ($data['posts'] as $notice)
            <div class="modal fade" id="viewPost-{{ $notice->id }}" tabindex="-1" aria-labelledby="viewPostLabel"
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
                                        value="{{ $notice->title }}">
                                </div>
                            </div>

                            @if (!is_null($notice->sub_title))
                                <div class="mb-1 row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Sub Title</label>
                                    <div class="col-sm-6">
                                        <small>{{ $notice->sub_title }}</small>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <p>{!! $notice->description !!}</p>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-2">
                                    @isset($notice->image)
                                                @php
                                                    $extension = explode('.', $notice->image)[1];
                                                @endphp
                                            @endisset
                                            @isset($notice->image)
                                                @if ($extension == 'pdf')
                                                    <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                        <img src="{{ asset('pdf-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'docx' || $extension == 'doc')
                                                    <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                        <img src="{{ asset('word-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @elseif($extension == 'xls' || $extension == 'xlsx')
                                                    <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                        <img src="{{ asset('excel-img.png') }}" alt=""
                                                            class="previewImage" width="40px" height="40">
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $notice->image) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $notice->image) }}" alt=""
                                                            class="previewImage" height="40px" height="40">
                                                    </a>
                                                @endif
                                            @endisset

                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $notice->createdBy?->name ?? '' }}</small>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $notice->createdBy?->name ?? '' }}</small>
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
                    url: "{{ route('notice.status') }}",
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
