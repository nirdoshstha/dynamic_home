@extends('backend.layouts.master')

@section('title')
    News And Events | Dashboard
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
                            <form action="{{ route('news_page.update', $data['page']) }}" method="POST"
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

                            <!--For Multiple Images Step 1-->
                            <div class="other_image">
                            </div>
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
                                            @if ($post->image)
                                                <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                                    class="previewImage" height="50px">
                                            @else
                                                <img src="{{ asset('no-image.png') }}" alt=""
                                                    class="previewImage" height="50px">
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">

                                        <textarea name="description" id="editor{{ $index }}" class="form-control description" rows="5"
                                            id="floatingTextarea" placeholder="Type Description" style="height:120px;"> {!! $post->description !!} </textarea>
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

                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                    <div class="datatable-top">
                        <div class="datatable-dropdown">
                            <label>
                                <select class="datatable-selector">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select> entries per page
                            </label>
                        </div>
                        <div class="datatable-search">
                            <input class="datatable-input" placeholder="Search..." type="search"
                                title="Search within table">
                        </div>
                    </div>
                    <div class="datatable-container">
                        <table class="table table-borderless datatable datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 10.655737704918032%;"><button
                                            class="datatable-sorter">#</button></th>
                                    <th data-sortable="true" style="width: 23.442622950819672%;"><button
                                            class="datatable-sorter">Name</button></th>
                                    <th data-sortable="true" style="width: 39.34426229508197%;"><button
                                            class="datatable-sorter">Description</button></th>
                                    <th data-sortable="true" style="width: 23.442622950819672%;"><button
                                            class="datatable-sorter">Image</button></th>
                                    <th data-sortable="true" style="width: 11.80327868852459%;"><button
                                            class="datatable-sorter">Status</button></th>
                                    <th data-sortable="true" style="width: 14.754098360655737%;"><button
                                            class="datatable-sorter">Action</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['posts'] as $news)
                                    <tr data-index="0">
                                        <td> {{ $loop->iteration }} </td>
                                        <td>
                                            <small> {{ $news->title }} </small>
                                        </td>
                                        <td>
                                            <small>{!! Str::limit(strip_tags($news->description), 70) !!}</small>
                                        </td>
                                        <td>
                                            @if (isset($news->image))
                                                <img src="{{ asset('storage/' . $news->image) }}" width="60"
                                                    class="img-float">
                                            @else
                                                <img src="{{ asset('no-image.png') }}" width="60" class="img-float">
                                            @endif
                                        </td>

                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input check-uncheck"
                                                    data-id="{{ $news->id }}" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $news->status == '0' ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewPost-{{ $news->id }}">
                                                    <i class="bi bi-eye-fill fs-5 p-2 text-success"></i></a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editPost-{{ $news->id }}">
                                                    <i class="bi bi-pencil-square fs-5 p-2"></i></a>

                                                <form action="{{ route($base_route . 'destroy', $news->id) }}"
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
                    <div class="datatable-bottom">
                        <div class="datatable-info">Showing 1 to 5 of 5 entries</div>
                        <nav class="datatable-pagination">
                            <ul class="datatable-pagination-list"></ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        {{-- Post View  --}}
        @foreach ($data['posts'] as $news)
            <div class="modal fade" id="viewPost-{{ $news->id }}" tabindex="-1" aria-labelledby="viewPostLabel"
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
                                        value="{{ $news->title }}">
                                </div>
                            </div>

                            @if (!is_null($news->sub_title))
                                <div class="mb-1 row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Sub Title</label>
                                    <div class="col-sm-6">
                                        <small>{{ $news->sub_title }}</small>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <p>{!! $news->description !!}</p>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-2">
                                    @isset($news->image)
                                        <img src="{{ asset('storage/' . $news->image) }}" class="img-thumbnail" width="60px"
                                            height="60px">
                                    @else
                                        <img src="{{ asset('no-image.png') }}" class="img-thumbnail" width="60px"
                                            height="60px">
                                    @endisset

                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $news->createdBy?->name ?? '' }}</small>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $news->createdBy?->name ?? '' }}</small>
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
                    url: "{{ route('news.status') }}",
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
                    url: "{{ route('news.status_menu') }}",
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
