@extends('backend.layouts.master')

@section('title')
    Edit Information |
@endsection

@section('sub_title', $panel)

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route($base_route.'index')}}">Home</a></li>
            <li class="breadcrumb-item ">@yield('sub_title')</li>
            <li class="breadcrumb-item active">Edit {{$data['information']->title}}</li>

        </ol>

    </nav>
</div>

<div class="card pt-3">
    <div class="card-body">
        <form action="{{ route($base_route . 'update', $data['information']->id) }}" method="POST"
            enctype="multipart/form-data" id="main_form" class="row g-3 main_form">
            @csrf
            @method('PUT')
            <input type="hidden" name="type" value="post">

            <div class="other_image">
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="title" class="form-control title"
                        value="{{ $data['information']->title }}" id="floatingName" placeholder="Title Name">
                    <label for="floatingName">Title</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="sub_title" class="form-control sub_title"
                        value="{{ $data['information']->sub_title }}" id="floatingName" placeholder="Subtitle Name">
                    <label for="floatingName">Sub Title</label>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 image">
                <label for="formFile" class="form-label">Image</label>
                <div class="form-group d-flex justify-content-between">

                    <input name="image" class="form-control file-input custom-file-input" type="file" id="formFile">


                    <div class="image">
                        @if ($data['information']->image)
                            <img src="{{ asset('storage/' . $data['information']->image) }}" alt=""
                                class="previewImage" height="50px">
                        @else
                            <img src="{{ asset('no-image.png') }}" alt="" class="previewImage" height="50px">
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="form-floating">
                    {{-- <input type="text" name="description" class="form-control description"
                value="" id="floatingName" placeholder="Your Name"> --}}
                    <textarea name="description" class="form-control description" rows="5" id="editor100"
                        placeholder="Type Description" style="height:120px;"> {!! $data['information']->description !!} </textarea>
                    <label for="floatingName">Description</label>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form><!-- End floating Labels Form -->

        {{-- multiple image step 2 --}}
        <form action="{{ route('admin.upload') }}" method="get" enctype="multipart/form-data">
            <div class="col-md-12 col-lg-12">
                <div class="form-group">
                    <label class="form-label" for="separated-input">Other Image</label>
                    <input id="demos" type="file" name="files"
                        accept=" image/jpeg, image/png, text/html, application/zip, text/css, text/js" multiple />
                </div>
            </div>
        </form>

        <!--Multiple images edit-->
        <div class="row">
            <div class="col-md-12 d-flex align-content-start flex-wrap">
                @forelse ($data['information']->images as $image)
                    <div class="image p-2">
                        <img src="{{ image_path($image->url) }}" alt="" width="60">
                    </div>
                    <div class="icon ">
                        <a href="{{ route('admin.delete.image', $image->id) }}">
                            <i class="bi bi-x-circle-fill fs-6 p-0 text-danger"></i>
                        </a>
                    </div>
                @empty
                    <small>No Image Found</small>
                @endforelse
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
@endpush
