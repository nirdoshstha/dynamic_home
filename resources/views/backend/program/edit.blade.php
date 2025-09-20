@extends('backend.layouts.master')

@section('title')
    Edit Program |
@endsection

@section('sub_title', $panel)

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($base_route . 'index') }}">Home</a></li>
                <li class="breadcrumb-item ">@yield('sub_title')</li>
                <li class="breadcrumb-item active">Edit {{ $data['program']->title }}</li>

            </ol>

        </nav>
    </div>

    <div class="card pt-3">
        <div class="card-body">
            <form action="{{ route($base_route . 'update', $data['program']->id) }}" method="POST"
                enctype="multipart/form-data" id="main_form" class="row g-3 main_form">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="post">

                <div class="other_image">
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="title" class="form-control title"
                            value="{{ $data['program']->title }}" id="floatingName" placeholder="Title Name">
                        <label for="floatingName">Title</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="sub_title" class="form-control sub_title"
                            value="{{ $data['program']->sub_title }}" id="floatingName" placeholder="Subtitle Name">
                        <label for="floatingName">Sub Title</label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12 image">
                    <label for="formFile" class="form-label">Image</label>
                    <div class="form-group d-flex justify-content-between">

                        <input name="image" class="form-control file-input custom-file-input" type="file"
                            id="formFile">


                        <div class="image">
                            @if ($data['program']->image)
                                <img src="{{ asset('storage/' . $data['program']->image) }}" alt=""
                                    class="previewImage" height="50px">
                            @else
                                <img src="{{ asset('no-image.png') }}" alt="" class="previewImage" height="50px">
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <textarea name="description" class="form-control description" rows="5" id="editor100"
                            placeholder="Type Description" style="height:120px;"> {!! $data['program']->description !!} </textarea>
                        <label for="floatingName">Description</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <textarea name="courses" class="form-control courses" rows="5" id="editor101" placeholder="Type courses"
                            style="height:120px;">{!! $data['program']->courses !!}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <textarea name="university" class="form-control university" rows="5" id="editor102" placeholder="Type university"
                            style="height:120px;">{!! $data['program']->university !!}</textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form><!-- End floating Labels Form -->





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
@endpush
