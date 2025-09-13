@extends('backend.layouts.master')

@section('title')
    Slider | Dashboard
@endsection

@section('sub_title', $panel ?? '');

@section('content')
    <div class="pagetitle">
        <h1>Dashboard
            @if (isset($base_route))
                {{-- @if (Route::is('setting.index')) --}}
                @if (Route::has($base_route . 'index'))
                    {{-- @if (request()->routeIs(['setting.*', 'profile.*', 'admin_create.*'])) --}}

                    <button type="button" class="btn btn-success m-1 float-end" data-bs-toggle="modal"
                        data-bs-target="#postModal"><i class="bi bi-plus-circle me-1"></i>
                        Post {{ $panel ?? '' }}</button>
                @else
                @endif
            @endif
        </h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route($base_route.'index')}}">Home</a></li>
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

                            <div class="col-sm-12 col-md-12 col-lg-12 image">
                                <label for="formFile" class="form-label">Image</label>
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
                                        <textarea name="description" class="form-control description" rows="5" id="floatingTextarea" placeholder="Type Description" style="height:120px;"> </textarea>
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
    @foreach($data['posts'] as $post)
    <div class="modal fade" id="editPost-{{$post->id}}" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Edit {{ $panel }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="card-body">
                        <form action="{{ route($base_route . 'update',$post->id) }}" method="POST" enctype="multipart/form-data"
                            id="main_form" class="row g-3 main_form">
                            @csrf
                            @method('PUT')


                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="title" class="form-control title" value="{{$post->title}}"
                                        id="floatingName" placeholder="Title">
                                    <label for="floatingName">Title</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="rank" class="form-control rank" value="{{$post->rank}}"
                                        id="floatingName" placeholder="Rank">
                                    <label for="floatingName">Rank</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 image">
                                <label for="formFile" class="form-label">Image</label>
                                <div class="form-group d-flex justify-content-between">

                                    <input name="image" class="form-control file-input custom-file-input"
                                        type="file" id="formFile">

                                        <div class="image">
                                            @isset($post->image)
                                                <img src="{{asset('storage/'.$post->image) }}" alt="" class="previewImage" width="70px" height="40px">
                                            @else
                                                <img src="{{ asset('no-image.png') }}" alt="" class="previewImage" height="50px">
                                            @endisset

                                        </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                        <textarea name="description" class="form-control description" rows="5" id="floatingTextarea" placeholder="Type Description" style="height:120px;"> {!! $post->description !!} </textarea>
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

                    <div class="datatable-container mt-2">
                        <table class="table table-borderless datatable datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 10.655737704918032%;"><button
                                            class="datatable-sorter">#</button></th>
                                    <th data-sortable="true" style="width: 23.442622950819672%;"><button
                                            class="datatable-sorter">Name</button></th>
                                            <th data-sortable="true" style="width: 39.34426229508197%;"><button
                                                class="datatable-sorter">Image</button></th>
                                            <th data-sortable="true" style="width: 39.34426229508197%;"><button
                                                class="datatable-sorter">Rank</button></th>
                                    <th data-sortable="true" style="width: 11.80327868852459%;"><button
                                            class="datatable-sorter">Status</button></th>
                                    <th data-sortable="true" style="width: 14.754098360655737%;"><button
                                            class="datatable-sorter">Action</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['posts'] as $slider)
                                    <tr data-index="0">
                                        <td> {{ $loop->iteration }} </td>
                                        <td>
                                            <small> {{ $slider->title }} </small>
                                        </td>
                                        <td>
                                            <div class="image">
                                                @isset($slider->image)
                                                    <img src="{{asset('storage/'.$slider->image) }}" alt="" class="previewImage" width="70px" height="40px">
                                                @else
                                                    <img src="{{ asset('no-image.png') }}" alt="" class="previewImage" height="50px">
                                                @endisset

                                            </div>
                                        </td>
                                        <td><small>{{ $slider->rank }}</small></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input check-uncheck"
                                                    data-id="{{ $slider->id }}" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $slider->status == '0' ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewPost-{{$slider->id}}">
                                                    <i class="bi bi-eye-fill fs-5 p-2 text-success"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editPost-{{$slider->id}}">
                                                    <i class="bi bi-pencil-square fs-5 p-2"></i></a>

                                                <form action="{{ route($base_route . 'destroy', $slider->id) }}"
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
        @foreach ($data['posts'] as $slider)
            <div class="modal fade" id="viewPost-{{$slider->id}}" tabindex="-1" aria-labelledby="viewPostLabel" aria-hidden="true">
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
                                        value="{{ $slider->title ?? '' }}">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-6">
                                    @if(@isset($slider->image))
                                    <img src="{{asset('storage/'.$slider->image)}}" class="img-thumbnail" width="60px">
                                        @else
                                        <img src="{{asset('no-image.png')}}" class="img-thumbnail" width="60px">

                                    @endisset

                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Rank</label>
                                <div class="col-sm-6">
                                    <small>{{ $slider->rank ?? '' }}</small>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-6">
                                    <small>{{ $slider->description ?? '' }}</small>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{$slider->createdBy?->name ?? ''}}</small>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{$slider->createdBy?->name ?? ''}}</small>
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
                    url: "{{ route('slider.status') }}",
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
