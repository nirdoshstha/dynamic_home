@extends('backend.layouts.master')

@section('title')
    Contact Us | Dashboard
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
                            <form action="{{ route($base_route.'update', $data['page']) }}" method="POST"
                                enctype="multipart/form-data" class="row g-3 main_form">
                                @csrf
                                @method('PUT')
                            @else
                                <form action="{{ route($base_route . 'store') }}" method="POST"
                                    enctype="multipart/form-data" class="row g-3 main_form">
                                    @csrf
                        @endif
                        <input type="hidden" name="type" value="page">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control name"
                                    value="{{ $data['page']->name ?? '' }}" id="floatingName" placeholder="Your Name">
                                <label for="floatingName">Name</label>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 image">
                            <label for="formFile" class="form-label">Banner</label>
                            <div class="form-group d-flex justify-content-between">

                                <input name="image" class="form-control file-input custom-file-input"
                                    type="file" id="formFile">

                                <div class="image">
                                    @isset($data['page']->image)
                                        <img src="{{asset('storage/'.$data['page']->image) }}" alt="" class="previewImage" height="50px">
                                    @else
                                        <img src="{{ asset('no-image.png') }}" alt="" class="previewImage" height="50px">
                                    @endisset

                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="message" class="form-control message" placeholder="Address" id="floatingTextarea"
                                    style="height: 100px;">{{ $data['page']->message ?? '' }}</textarea>
                                <label for="floatingTextarea">Description</label>
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


    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">

                    <div class="datatable-container">
                        <table class="table table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 10.655737704918032%;"><button
                                            class="datatable-sorter">#</button></th>
                                    <th data-sortable="true" style="width: 23.442622950819672%;"><button
                                            class="datatable-sorter">Name</button></th>
                                    <th data-sortable="true" style="width: 39.34426229508197%;"><button
                                            class="datatable-sorter">Email</button></th>
                                    <th data-sortable="true" style="width: 23.442622950819672%;"><button
                                            class="datatable-sorter">Message</button></th>
                                            <th data-sortable="true" style="width: 23.442622950819672%;"><button
                                                class="datatable-sorter">Created Date</button></th>
                                    <th data-sortable="true" style="width: 14.754098360655737%;"><button
                                            class="datatable-sorter">Action</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['posts'] as $contact)
                                    <tr data-index="0">
                                        <td> {{ $loop->iteration }} </td>
                                        <td>
                                            <small> {{ $contact->name }} </small>
                                        </td>
                                        <td><small>{{ $contact->email}}</small></td>
                                        <td> <small>{!! Str::limit($contact->message,120) !!}</small></td>
                                        <td><small>{{$contact->created_at->format('Y-m-d')}}</small></td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewPost-{{$contact->id}}">
                                                    <i class="bi bi-eye-fill fs-5 p-3 text-success"></i></a>


                                                <form action="{{ route($base_route . 'destroy', $contact->id) }}"
                                                    method="POST" class="main_form" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#user-20">
                                                        <i
                                                            class="bi bi-x-circle-fill fs-5 p-3 text-danger delete-confirm"></i></a>
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
        @foreach ($data['posts'] as $contact)
            <div class="modal fade" id="viewPost-{{$contact->id}}" tabindex="-1" aria-labelledby="viewPostLabel" aria-hidden="true">
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
                                        value="{{ $contact->name }}">
                                </div>
                            </div>


                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-6">
                                    <small>{{ $contact->email }}</small>
                                </div>
                            </div>


                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Message</label>
                                <div class="col-sm-10">
                                    <p>{!! $contact->message !!}</p>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-2">
                                    <p>{{ $contact->subject }}</p>

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
                    url: "{{ route('contact.status') }}",
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
