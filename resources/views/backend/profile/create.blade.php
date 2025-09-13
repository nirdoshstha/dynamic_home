@extends('backend.layouts.master')

@section('title')
    My Profile | Admin Dashboard
@endsection

@section('sub_title', $panel ?? '')

@section('content')

<div class="pagetitle">
    <h1>Dashboard </h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route($base_route.'create')}}">Home</a></li>
            <li class="breadcrumb-item active">@yield('sub_title')</li>

        </ol>

    </nav>

</div><!-- End Page Title -->


    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if (isset($data['profile']->image))
                            <img src="{{ asset($data['profile']->image) }}" alt="Profile" class="rounded-circle">
                        @else
                            <img src="{{ asset('no-image.png') }}" alt="Profile" class="rounded-circle">
                        @endif
                        <h2>{{ auth()->user()->name ?? '' }}</h2>
                        <h3>{{ isset($data['profile']) ? $data['profile']->designation : '' }}</h3>
                        <div class="social-links mt-2">
                            @foreach ($data['socials'] as $socials)
                                <a href="{{ $socials->link ?? '' }}" class="{{ strtolower($socials->name) }}"><i
                                        class="{{ $socials->icon }}"></i></a>
                            @endforeach
                        </div>
                        @if (auth()->user()->user_role == '2')
                            <button class="btn btn-success btn-sm float-end mt-2">SuperAdmin</button>
                        @elseif (auth()->user()->user_role == '1')
                            <button class="btn btn-primary btn-sm float-end mt-2">Admin</button>
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                    aria-selected="false" role="tab" tabindex="-1">Overview</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                    aria-selected="true" role="tab">Edit Profile</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"
                                    aria-selected="false" role="tab" tabindex="-1">Social Media</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"
                                    aria-selected="false" role="tab" tabindex="-1">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade profile-overview" id="profile-overview" role="tabpanel">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic">{{ $data['profile']->description ?? '' }}</p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->name ?? '' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Company</div>
                                    <div class="col-lg-9 col-md-8">{{ $data['profile']->company ?? '' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Job</div>
                                    <div class="col-lg-9 col-md-8">{{ $data['profile']->designation ?? '' }}</div>
                                </div>



                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $data['profile']->address ?? '' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $data['profile']->phone ?? '' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->email ?? '' }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3 active show" id="profile-edit" role="tabpanel">

                                <!-- Profile Edit Form -->
                                @if (isset($data['profile']))
                                    <form action="{{ route($base_route . 'update', $data['profile']->id) }}" method="POST"
                                        id="main_form" enctype="multipart/form-data" class="main_form">
                                        @csrf
                                        @method('PUT')
                                    @else
                                        <form action="{{ route($base_route . 'store') }}" method="POST" id="main_form"
                                            enctype="multipart/form-data" class="main_form">
                                            @csrf
                                @endif

                                <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                        Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        @if (isset($data['profile']->image))
                                            <img src="{{ asset($data['profile']->image) }}" alt="Profile">
                                        @else
                                            <img src="{{ asset('no-image.png') }}" alt="Profile">
                                        @endif

                                        <div class="pt-3">
                                            <input type="file" name="image" class="btn-sm btn btn-primary"
                                                title="Upload new profile image" style="width:210px ">
                                            <a href="#" class="btn btn-danger btn-sm"
                                                title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                        Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="name"
                                            value="{{ auth()->user()->name ?? '' }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                    <div class="col-md-8 col-lg-9">
                                        <textarea name="description" class="form-control description" id="description" style="height: 100px">{{ isset($data['profile']) ? $data['profile']->description : '' }}
                                            </textarea>
                                        {{-- <span class="text-danger">{{ $errors->first('description') }}</span> --}}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="company" type="text" class="form-control company" id="company"
                                            value="{{ isset($data['profile']) ? $data['profile']->company : '' }}">
                                        {{-- <span class="text-danger">{{ $errors->first('company') }}</span> --}}

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="designation" type="text" class="form-control" id="designation"
                                            value="{{ isset($data['profile']) ? $data['profile']->designation : '' }}">
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="address" type="text" class="form-control" id="Address"
                                            value="{{ isset($data['profile']) ? $data['profile']->address : '' }} ">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control phone" id="phone"
                                            value="{{ isset($data['profile']) ? $data['profile']->phone : '' }}">
                                        {{-- <span class="text-danger">{{ $errors->first('phone') }}</span> --}}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email"
                                            value="{{ auth()->user()->email ?? '' }}">
                                    </div>
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                                <!-- Settings Form -->
                                <form action="{{ route('profile.social_media') }}" method="POST"
                                    enctype="multipart/form-data" id="main_form" class="main_form">
                                    @csrf
                                    <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="profile_id" value="{{ $data['profile']->id ?? '' }}">
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-lg-12">
                                            <table class="table table-borderless" id="image_wrapper" style="border: 0px">
                                                <tbody>
                                                    <tr>
                                                        <th class="bg-light" style="width: 20%"><label
                                                                class="form-label fw-bold">Name</label></th>
                                                        <th class="bg-light" style="width: 40%"><label
                                                                class="form-label fw-bold">Link</label></th>
                                                        <th class="bg-light" style="width: 24%"><label
                                                                class="form-label fw-bold">Icon</label></th>
                                                        <th class="bg-light" style="width: 8%"><label
                                                                class="form-label fw-bold">Rank</label></th>
                                                        <th class="bg-light" style="width: 8%">
                                                            <label class="form-label fw-bold">
                                                                <div>
                                                                    <i class="bi bi-plus-circle-fill text-success fs-3"
                                                                        id="addMoreImage"></i>

                                                                </div>
                                                        </th>

                                                    </tr>

                                                    @foreach ($data['socials'] as $socialmedia)
                                                        <tr>
                                                            <input type="hidden" name="social_id[]"
                                                                value="{{ $socialmedia->id }}">
                                                            <td>
                                                                <input type="text" name="name[]"
                                                                    class="form-control name"
                                                                    value="{{ isset($socialmedia) ? $socialmedia->name : '' }}"
                                                                    required>

                                                            </td>
                                                            <td>
                                                                <input type="text" name="link[]"
                                                                    class="form-control link[]"
                                                                    value="{{ isset($socialmedia) ? $socialmedia->link : '' }}"
                                                                    required>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="icon[]"
                                                                    class="form-control icon[]"
                                                                    value="{{ isset($socialmedia) ? $socialmedia->icon : '' }}"
                                                                    placeholder="bi bi-facebook" required>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rank[]"
                                                                    class="form-control rank[]"
                                                                    value="{{ isset($socialmedia) ? $socialmedia->rank : '' }}">
                                                            </td>
                                                            @isset($socialmedia)
                                                                <td class="d-flex justify-content-center">
                                                                    <a href="javascript:void(0)"
                                                                        data-id="{{ $socialmedia->id }}"
                                                                        class="remove_social_media">
                                                                        <i class="bi bi-trash-fill text-danger fs-5"></i>
                                                                    </a>
                                                                </td>
                                                            @endisset

                                                        </tr>
                                                    @endforeach
                                                    <tr>


                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                <!-- Change Password Form -->
                                <form action="{{ route('profile.change_password') }}" method="POST" id="main_form" class="main_form">
                                    @csrf
                                    <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Old
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="old_password" type="password" class="form-control old_password"
                                                id="currentPassword">
                                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="new_password" type="password" class="form-control new_password"
                                                id="newPassword">
                                            <span class="text-danger">{{ $errors->first('new_password') }}</span>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="confirm_new_password" type="password"
                                                class="form-control confirm_new_password" id="renewPassword">
                                            <span class="text-danger">{{ $errors->first('confirm_new_password') }}</span>

                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('backend/assets/js/general.js') }}"></script>

    <script>
        var z = 1;
        $('#addMoreImage').click(function() {
            var max_fields = 5;
            if (z < max_fields) { //max input box allowed
                z++;
                $("#image_wrapper tr:last").before(`<tr>
                    <td>
                        <input type="text" name="name[]" class="form-control" required >
                    </td>
                    <td>
                        <input type="text" name="link[]" class="form-control" required >
                    </td>
                    <td>
                        <input type="text" name="icon[]" class="form-control"  placeholder="bi bi-facebook" required >
                    </td>
                    <td>
                        <input type="text" name="rank[]" class="form-control" >
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

    <script>
        $(document).ready(function() {
            $('.remove_social_media').on('click', function(e) {
                e.preventDefault();
                let current = $(this);
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('social_media.destory') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        current.parents("tr").remove();
                        // toast(res.success_message);
                        toastr.success(res.success_message);
                    }
                });

            })
        })
    </script>
@endpush
