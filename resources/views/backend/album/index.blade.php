@extends('backend.layouts.master')

@section('title')
    Album | Dashboard
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
                            <form action="{{ route('album_page.update', $data['page']) }}" method="POST"
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

                        <div class="col-md-12">
                            <div class="form-floating">
                                <div class="d-flex justify-content-between">
                                    <label for="floatingName">Banner</label>
                                    <input type="file" name="image" class="form-control" id="floatingName"
                                        placeholder="Your Name">
                                    @if (isset($data['page']->image))
                                        <img src="{{ asset('storage/' . $data['page']->image) }}" width="60"
                                            class="img-float">
                                    @else
                                        <img src="{{ asset('no-image.png') }}" width="60" class="img-float">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="description" class="form-control description" placeholder="Address" id="floatingTextarea"
                                    style="height: 100px;">{{ $data['page']->description ?? '' }}</textarea>
                                <label for="floatingTextarea">Description</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="seo_title" value="{{ $data['page']->seo_title ?? '' }}"
                                    class="form-control" id="floatingEmail" placeholder="Your Email">
                                <label for="floatingEmail">Seo Title</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="seo_keyword" value="{{ $data['page']->seo_keyword ?? '' }}"
                                    class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Seo Keyword</label>
                            </div>
                        </div>
                        <div class="col-4">
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
                                        id="floatingName" placeholder="Album Name">
                                    <label for="floatingName">Title</label>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" name="image" class="form-control image" value=""
                                        id="floatingName" placeholder="Your Name">
                                    <label for="floatingName">Image</label>
                                </div>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End floating Labels Form -->

                        {{-- multiple image step 2 --}}
                        <form action="{{ route('admin.upload') }}" method="get" enctype="multipart/form-data">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="separated-input">Other Image</label>
                                    <input id="demos" type="file" name="files"
                                        accept=" image/jpeg, image/png, text/html, application/zip, text/css, text/js"
                                        multiple />
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <h5 class="card-title">{{ $panel ?? '' }} <span>| List</span></h5>

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
                                            class="datatable-sorter">Album Name</button></th>
                                    <th data-sortable="true" style="width: 39.34426229508197%;"><button
                                            class="datatable-sorter">Total Galleries</button></th>
                                    <th data-sortable="true" style="width: 11.80327868852459%;"><button
                                            class="datatable-sorter">Status</button></th>
                                    <th data-sortable="true" style="width: 14.754098360655737%;"><button
                                            class="datatable-sorter">Action</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['posts'] as $albums)
                                    <tr data-index="0">
                                        <td><a href="#">{{ $loop->iteration }}</a></td>
                                        <td>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">

                                                <div>{{ $albums->title }}</div>

                                            </li>
                                        </td>
                                        <td>

                                            <a href="{{ route($base_route . 'edit', $albums->id) }}">
                                                <span
                                                    class="badge bg-dark rounded-pill">{{ $albums->images->count() }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input check-uncheck"
                                                    data-id="{{ $albums->id }}" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $albums->status == '0' ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                {{-- <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit-album-{{ $albums->id }}"><i
                                                        class="bi bi-pencil-square fs-5 p-1"></i></a> --}}
                                                <a href="{{ route($base_route . 'edit', $albums->id) }}"><i
                                                        class="bi bi-pencil-square fs-5 p-1"></i></a>

                                                <form action="{{ route($base_route . 'destroy', $albums->id) }}"
                                                    method="POST" class="main_form" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#user-10">
                                                        <i
                                                            class="bi bi-x-circle-fill fs-5 p-1 text-danger delete-confirm"></i></a>
                                                </form>
                                            </div>



                                        </td>
                                    </tr>
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
    </div>
@endsection

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/general.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>

    <script>
        $(function() {
            var token;

            $('#demos').FancyFileUpload({


                params: {


                    action: 'fileuploader',
                    _token: '{{ csrf_token() }}'
                },
                maxfilesize: 1000000,

                continueupload: function(e, data) {
                    var ts = Math.round(new Date().getTime() / 1000);


                    // Alternatively, just call data.abort() or return false here to terminate the upload but leave the UI elements alone.
                    if (token.expires < ts) data.ff_info.RemoveFile();
                },
                uploadcompleted: function(e, data) {


                    $('.other_image').append(
                        `<input type="hidden" name="other_image[]" value="${data.result.image_id}">`
                    );
                    // console.log(e);
                    // data.ff_info.RemoveFile();
                }
            });

        });
    </script>



    <script>
        $(document).ready(function() {
            $('.check-uncheck').click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('album.status') }}",
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


    <script>
        var z = 1;
        $('#addMoreImage').click(function() {
            var max_fields = 3;
            if (z < max_fields) { //max input box allowed
                z++;
                $("#image_wrapper tr:last").before(`<tr>
                                                        <input type="hidden" name="social_id[]"
                                                            value=" ">
                                                        <td>
                                                            <input type="text" name="name[]"
                                                                class="form-control name[]"
                                                                value=" "
                                                                required>

                                                        </td>
                                                        <td>
                                                            <input type="file" name="image[]"
                                                                class="form-control image[]"
                                                                value=" "
                                                                required>
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
@endpush
