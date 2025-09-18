@extends('backend.layouts.master')

@section('title')
    Section Rank | Dashboard
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

                                {{-- <input type="text" name="name" class="form-control name" value=""
                                        id="floatingName" placeholder="Title Name">
                                    <label for="floatingName">Title</label> --}}
                                <select class="form-select name" name="name" id="floatingSelect">
                                    <option selected disabled>Please Select Section</option>
                                    <option value="section_about">Section About</option>
                                    <option value="section_counter">Section Counter</option>
                                    <option value="section_team">Section Mangement Team</option>
                                    <option value="section_news">Section News & Events</option>
                                    <option value="section_video">Section Video</option>
                                    <option value="section_album">Section Album</option>
                                    <option value="section_testimonial">Section Testimonial</option>
                                </select>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="link" class="form-control link" value=""
                                        id="floatingName" placeholder="Number">
                                    <label for="floatingName">Count Number</label>
                                </div>
                            </div> --}}

                            <div class="col-md-6">

                                <input type="number" name="rank" class="form-control rank" value=""
                                    id="floatingName" placeholder="Rank">
                                {{-- <label for="floatingName">Rank</label> --}}
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
                                    <select class="form-select name" name="name" id="floatingSelect">
                                        {{-- <option selected disabled>Please Select Section</option> --}}
                                        <option value="section_about"
                                            {{ $post->name == 'section_about' ? 'selected' : '' }}>
                                            Section About</option>
                                        <option value="section_counter"
                                            {{ $post->name == 'section_counter' ? 'selected' : '' }}>
                                            Section Counter</option>
                                        <option value="section_team" {{ $post->name == 'section_team' ? 'selected' : '' }}>
                                            Section Management Team</option>
                                        <option value="section_news" {{ $post->name == 'section_news' ? 'selected' : '' }}>
                                            Section News & Events</option>
                                        <option value="section_video"
                                            {{ $post->name == 'section_video' ? 'selected' : '' }}>
                                            Section Video</option>
                                        <option value="section_album"
                                            {{ $post->name == 'section_album' ? 'selected' : '' }}>
                                            Section Album</option>
                                        <option value="section_testimonial"
                                            {{ $post->name == 'section_testimonial' ? 'selected' : '' }}>Section
                                            Testimonial</option>
                                    </select>
                                </div>

                                {{-- <div class="col-md-5">
                                    <div class="form-floating">
                                        <input type="text" name="link" class="form-control link"
                                            value="{{ $post->link }}" id="floatingName" placeholder="Link Name">
                                        <label for="floatingName">Link</label>
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="rank" class="form-control rank"
                                            value="{{ $post->rank }}" id="floatingName" placeholder="Rank">
                                        <label for="floatingName">Rank</label>
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
                                            class="">#</button></th>
                                    <th data-sortable="true" style="width: 23.442622950819672%;"><button
                                            class="">Name</button></th>
                                    <th data-sortable="true" style="width: 23.442622950819672%;"><button
                                            class="">For</button></th>

                                    {{-- <th data-sortable="true" style="width: 39.34426229508197%;"><button
                                            class="">Link</button></th> --}}

                                    <th data-sortable="true" style="width: 39.34426229508197%;"><button
                                            class="">Rank</button></th>

                                    <th data-sortable="true" style="width: 11.80327868852459%;"><button
                                            class="">Status</button></th>
                                    <th data-sortable="true" style="width: 14.754098360655737%;"><button
                                            class="">Action</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['posts'] as $section)
                                    <tr data-index="0">
                                        <td> {{ $loop->iteration }} </td>
                                        <td>
                                            <small> {{ $section->link }} </small>
                                        </td>
                                        <td><small>
                                                @if ($section->name == 'section_about')
                                                    <p>About</p>
                                                @elseif ($section->name == 'section_counter')
                                                    <p>Counter</p>
                                                @elseif ($section->name == 'section_team')
                                                    <p>Management Team</p>
                                                @elseif ($section->name == 'section_news')
                                                    <p>News & Events</p>
                                                @elseif ($section->name == 'section_video')
                                                    <p>Video</p>
                                                @elseif ($section->name == 'section_album')
                                                    <p>Album</p>
                                                @elseif ($section->name == 'section_testimonial')
                                                    <p>Testimonial</p>
                                                @else
                                                    <p>Not Found</p>
                                                @endif
                                            </small></td>

                                        <td><small>{{ $section->rank }}</small></td>

                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input check-uncheck"
                                                    data-id="{{ $section->id }}" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $section->status == '0' ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewPost-{{ $section->id }}">
                                                    <i class="bi bi-eye-fill fs-5 p-2 text-success"></i></a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editPost-{{ $section->id }}">
                                                    <i class="bi bi-pencil-square fs-5 p-2"></i></a>

                                                <form action="{{ route($base_route . 'destroy', $section->id) }}"
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
        @foreach ($data['posts'] as $section)
            <div class="modal fade" id="viewPost-{{ $section->id }}" tabindex="-1" aria-labelledby="viewPostLabel"
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
                                        value="{{ $section->name ?? '' }}">
                                </div>
                            </div>

                            {{-- <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Count</label>
                                <div class="col-sm-6">
                                    <small>{{ $section->link ?? '' }}</small>
                                </div>
                            </div> --}}

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Rank</label>
                                <div class="col-sm-6">
                                    <small>{{ $section->rank ?? '' }}</small>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $section->createdBy?->name ?? '' }}</small>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Created by</label>
                                <div class="col-sm-4 mt-2">
                                    <small>{{ $section->createdBy?->name ?? '' }}</small>
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
                    url: "{{ route('section.status') }}",
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
