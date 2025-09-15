@extends('backend.layouts.master')

@section('title')
    About Us Post | Dashboard
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('sub_title', $panel ?? '');

@section('content')
    <div class="pagetitle">
        <h1>Dashboard
            @if (isset($base_route))
                @if (Route::has($base_route . 'index'))
                    <button class="btn btn-default float-end m-1">
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input menu-hide bg-{{ $data['page']->status == 0 ? 'success' : 'danger' }}"
                                data-id="{{ $data['page']->id ?? '' }}" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked" {{ $data['page']->status == 0 ? 'checked' : '' }}>
                            <i class="bi bi-menu-button"></i>
                            <span id="status-info"
                                class="{{ $data['page']->status == 0 ? 'text-success' : 'text-danger' }}">{{ $data['page']->status == 0 ? 'Menu is visible' : 'Menu is hidden' }}
                            </span>
                        </div>
                    </button>

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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                            <form action="{{ route('about_page.update', $data['page']) }}" method="POST"
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
                                <input type="text" name="name" class="form-control name"
                                    value="{{ $data['page']->name ?? '' }}" id="floatingName" placeholder="Your Name">
                                <label for="floatingName">Title</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="designation" value="{{ $data['page']->designation ?? '' }}"
                                    class="form-control designation" id="floatingName" placeholder="Your Name">
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
                                <textarea name="description" class="form-control description" placeholder="Address" id="editor" rows="3">{{ $data['page']->description ?? '' }}</textarea>
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
                                    <select name="category_id" class="form-select">
                                        <option value="" selected>Please Select Category</option>
                                        @foreach ($data['categories'] as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->title }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingName">Category</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control name" value=""
                                        id="floatingName" placeholder="Name">
                                    <label for="floatingName">Name</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="designation" class="form-control designation"
                                        value="" id="floatingName" placeholder="Subtitle Name">
                                    <label for="floatingName">Designation</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="rank" class="form-control rank" value=""
                                        id="floatingName" placeholder="Rank">
                                    <label for="floatingName">Rank</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 image">
                                <label for="formFile" class="form-label">Banner</label>
                                <div class="form-group d-flex justify-content-between">

                                    <input name="image" class="form-control file-input custom-file-input"
                                        type="file" id="formFile">

                                    <div class="image">
                                        <img src="" alt="" class="previewImage" height="50px">
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea name="description" id="editor100" class="form-control" rows="3" style="height: 100px;"></textarea>
                                    <label for="floatingName">Description</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" name="seo_title" value="" class="form-control"
                                        id="floatingEmail" placeholder="Your Email">
                                    <label for="floatingEmail">Seo Title</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" name="seo_keyword" value="" class="form-control"
                                        id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Seo Keyword</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control" name="seo_description" placeholder="Address" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Seo Description</label>
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
                                        <select name="category_id" class="form-select">
                                            <option value="{{ isset($post) ? $post->category?->id : '' }}" selected>
                                                {{ isset($post) ? $post->category?->title : 'Please Selct Category' }}
                                            </option>
                                            @foreach ($data['categories'] as $categories)
                                                <option value="{{ $categories->id }}">{{ $categories->title }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingName">Category</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control name"
                                            value="{{ $post->name }}" id="floatingName" placeholder="Name">
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
                                        <input type="text" name="rank" class="form-control rank"
                                            value="{{ $post->rank }}" id="floatingName" placeholder="Rank">
                                        <label for="floatingName">Rank</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 image">
                                    <label for="formFile" class="form-label">Banner</label>
                                    <div class="form-group d-flex justify-content-between">

                                        <input name="image" class="form-control file-input custom-file-input"
                                            type="file" id="formFile">

                                        <div class="image">
                                            @isset($post->image)
                                                <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                                    class="previewImage" width="70px" height="40px">
                                            @else
                                                <img src="{{ asset('no-image.png') }}" alt="" class="previewImage"
                                                    height="50px">
                                            @endisset

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea name="description" id="editor{{ $index }}" class="form-control editor" rows="3"
                                            style="height: 100px;">{{ $post->description }}</textarea>
                                        <label for="floatingName">Description</label>
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
                    <table class="table table-borderless" id="datatable">
                        <thead>
                            <tr>
                                <th>#</button></th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Designation</button></th>
                                {{-- <th>Image</button></th> --}}
                                <th>Rank</button></th>
                                <th>Status</button></th>
                                <th>Action</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['posts'] as $about)
                                <tr data-index="0">
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <small> {{ $about->name }} </small>
                                    </td>
                                    <td>
                                        <small> {{ $about->category?->title }} </small>
                                    </td>
                                    <td><small>{{ $about->designation }}</small></td>
                                    {{-- <td>
                                        <div class="image">
                                            @isset($about->image)
                                                <img src="{{asset('storage/'.$about->image) }}" alt="" class="previewImage" width="40px" height="40px">
                                            @else
                                                <img src="{{ asset('no-image.png') }}" alt="" class="previewImage" width="40px" height="40px">
                                            @endisset

                                        </div>
                                    </td> --}}
                                    <td><small>{{ $about->rank }}</small></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input check-uncheck" data-id="{{ $about->id }}"
                                                type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                                {{ $about->status == '0' ? 'checked' : '' }}>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#viewPost-{{ $about->id }}">
                                                <i class="bi bi-eye-fill fs-5 p-2 text-success"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#editPost-{{ $about->id }}">
                                                <i class="bi bi-pencil-square fs-5 p-2"></i></a>

                                            <form action="{{ route($base_route . 'destroy', $about->id) }}"
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
        @foreach ($data['posts'] as $about)
            <div class="modal fade" id="viewPost-{{ $about->id }}" tabindex="-1" aria-labelledby="viewPostLabel"
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
                                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $about->name ?? '' }}">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $about->designation ?? '' }}">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Rank</label>
                                <div class="col-sm-6">
                                    <small>{{ $about->rank ?? '' }}</small>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Rank</label>
                                <div class="col-sm-6">
                                    <div class="image">
                                        @isset($about->image)
                                            <img src="{{ asset('storage/' . $about->image) }}" alt=""
                                                class="previewImage" width="70px">
                                        @else
                                            <img src="{{ asset('no-image.png') }}" alt="" class="previewImage"
                                                width="70px>
@endisset

                                    </div>
                                </div>
                            </div>

                            <div class="mb-1
                                                row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-6">
                                                <p>{!! $about->description !!}</p>
                                            </div>
                                        </div>


                                        <div class="mb-1 row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                            <div class="col-sm-4 mt-2">
                                                <small>{{ $about->createdBy?->name ?? '' }}</small>
                                            </div>
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                            <div class="col-sm-4 mt-2">
                                                <small>{{ $about->createdBy?->name ?? '' }}</small>
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
            $(document).ready(function() {
                $('.check-uncheck').click(function() {
                    let id = $(this).attr('data-id');
                    $.ajax({
                        url: "{{ route('about.status') }}",
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

            $(document).on('click', '.menu-hide', function() {
                let btn = $(this);
                let id = btn.data('id');

                $.ajax({
                    url: "{{ route('about.status_menu') }}",
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
        </script>
    @endpush
