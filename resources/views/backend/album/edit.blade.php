@extends('backend.layouts.master')

@section('title')
    Edit Album | Dashboard
@endsection

@section('sub_title', 'Edit' . ' ' . $panel ?? '')

@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($base_route . 'index') }}">Home</a></li>
                <li class="breadcrumb-item active">@yield('sub_title')</li>

            </ol>

        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route($base_route . 'update', $data['album']->id) }}" method="POST" enctype="multipart/form-data"
                class="row g-3 main_form">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="post">
                <div class="other_image">
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="title" class="form-control title"
                            value="{{ $data['album']->title ?? '' }}" id="floatingName" placeholder="Album Name">
                        <label for="floatingName">Title</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating d-flex justify-content-between">
                        @if (isset($data['album']->image))
                            <img src="{{ asset('storage/' . $data['album']->image) }}" class="img-thumbnail" width="60">
                        @else
                            <img src="{{ asset('no-image.png') }}" class="img-thumbnail" width="60">
                        @endif
                        <input type="file" name="image" class="form-control image" value="" id="floatingName"
                            placeholder="Your Name">
                        {{-- <label for="floatingName">Image</label> --}}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <textarea name="description" class="form-control description" id="floatingName">{{ $data['album']->description ?? '' }}</textarea>
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
                        <label class="form-label" for="separated-input">Other Multiple Images</label>
                        <input id="demo" type="file" name="files"
                            accept=" image/jpeg, image/png, text/html, application/zip, text/css, text/js" multiple />
                    </div>
                </div>
            </form>

            {{-- multiple image edit show delete 9th step --}}
            <div class="row p-3">
                <div class="col-md-12 d-flex align-content-start flex-wrap">
                    @isset($data['album']->images)
                        @foreach ($data['album']->images as $image)
                            <div class="image p-2">
                                <img src="{{ image_path($image->url) }}" alt="" height="50px">
                            </div>
                            <div class="icon ">

                                <a href="{{ route('admin.delete.image', $image->id) }}">
                                    <i class="bi bi-x-circle-fill fs-5 p-1 text-danger"></i>
                                    <input type="checkbox" name="status" class="show_hide" data-id="{{ $image->id }}"
                                        {{ $image->status == 0 ? 'checked' : '' }}>
                                </a>


                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/general.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.show_hide').on('click', function() {

                let id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('imageable.status') }}",
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        successAlert(resp.success_message)
                    },
                    error: function(err) {
                        error(resp.error_message)
                    }
                })
            })
        })
    </script>

    <script src="{{ asset('backend/assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script>
        $(function() {
                    var token;

                    $('#demo').FancyFileUpload({

                                params: {

                                    action: 'fileuploader',
                                    _token: '{{ csrf_token() }}'
                                },
                                maxfilesize: 3000000,

                                continueupload: function(e, data) {
                                        var ts = Math.round(new Date().getTime() / 1000);

                                        // Alternatively, just call data.abort() or return false here to terminate the upload but leave the UI elements alone.
                                        // if (token.expires <script ts) data.ff_info.RemoveFile();
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
