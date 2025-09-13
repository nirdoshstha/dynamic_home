@extends('backend.layouts.master')

@section('title')
    Admin Create |Admin Dashboard
@endsection

@section('sub_title', $panel ?? '')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route($base_route.'index')}}">Home</a></li>
                <li class="breadcrumb-item active">@yield('sub_title')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <div class="row">
        <div class="col-8">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Total Admin List </h5>

                    <table class="table table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['rows'] as $users)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $users->name }}</td>
                                    <td><a href="#" class="text-primary">{{ Str::limit($users->email, 15) }}</a>
                                    </td>
                                    <td>
                                        @if ($users->user_role == 0)
                                            User
                                        @elseif($users->user_role == 1)
                                            Admin
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#view-{{ $users->id }}"><i
                                                class="bi bi-eye-fill fs-6 p-1"></i></a>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#user-{{ $users->id }}"><i
                                                class="bi bi-pencil-square fs-6 p-1"></i></a>
                                        <span
                                            class="badge bg-{{ $users->is_banned == '0' ? 'success' : 'danger' }}">{{ $users->is_banned == '0' ? 'Unban' : 'Banned' }}</span>
                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                    {{-- //View Details --}}
                    @foreach ($data['rows'] as $user)
                        <div class="modal fade" id="view-{{ $user->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span>View Details</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="card-body">


                                            <!-- Floating Labels Form -->
                                            <form class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" value="{{ isset($user) ? $user->name : '' }}"
                                                            class="form-control" id="floatingName" placeholder="Your Name"
                                                            readonly>
                                                        <label for="floatingName">Your Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            value="{{ isset($user) ? $user->username : '' }}"
                                                            class="form-control" id="floatingName" placeholder="Your Name"
                                                            readonly>
                                                        <label for="floatingName">Your Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="email"
                                                            value="{{ isset($user) ? $user->email : '' }}"
                                                            class="form-control" id="floatingEmail" placeholder="Your Email"
                                                            readonly>
                                                        <label for="floatingEmail">Your Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" value="{{ $user->profile->phone ?? '' }}"
                                                            class="form-control" id="floatingPassword"
                                                            placeholder="Password" readonly>
                                                        <label for="floatingPassword">Phone</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="email" value="{{ $user->profile->company ?? '' }}"
                                                            class="form-control" id="floatingEmail" placeholder="Your Email"
                                                            readonly>
                                                        <label for="floatingEmail">Company</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            value="{{ $user->profile->designation ?? '' }}"
                                                            class="form-control" id="floatingPassword"
                                                            placeholder="Password" readonly>
                                                        <label for="floatingPassword">Designation</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="">User Role</label>
                                                        @if ($user->user_role == '2')
                                                            <span class="badge bg-primary rounded-pill">Super Admin</span>
                                                        @elseif ($user->user_role == '1')
                                                            <span class="badge bg-success rounded-pill">Admin</span>
                                                        @elseif ($user->user_role == '0')
                                                            <span class="badge bg-success rounded-pill">User</span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="">Is Banned</label>
                                                        @if ($user->is_banned == '0')
                                                            <span class="badge bg-success rounded-pill">Unban</span>
                                                        @elseif ($user->is_banned == '1')
                                                            <span class="badge bg-danger rounded-pill">Banned</span>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="col-lg-8">
                                                    <ol class="list-group list-group-numbered">
                                                        {{-- {{$user->profile?->id ?? 'Not Created'}} --}}

                                                        @php
                                                            $profile_id = $user->profile?->id;
                                                            $social_media = App\Models\General::where('type', 'profile')
                                                                ->where('profile_id', $profile_id)
                                                                ->orderBy('rank', 'asc')
                                                                ->get();
                                                        @endphp
                                                        @forelse ($social_media as $socialsmedia)
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 d-flex justify-content-center me-auto">
                                                                    <div class="fw-bold"><a
                                                                            href="{{ $socialsmedia->link }}">{{ $socialsmedia->name }}</a>
                                                                    </div>

                                                                </div>
                                                                <span class="badge bg-secondary rounded-pill"><i
                                                                        class="{{ $socialsmedia->icon }} fs-6"></i></span>
                                                            </li>

                                                        @empty
                                                            <li>Not found Social media</li>
                                                        @endforelse
                                                    </ol>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        @if (isset($user->profile->image))
                                                            <img src="{{ asset($user->profile->image) }}" width="120"
                                                                class="img-thumbnail">
                                                        @else
                                                            <img src="{{ asset('no-image.png') }}" width="120"
                                                                class="img-thumbnail">
                                                        @endif
                                                        {{-- <input type="text" value="{{ isset($user) ? $user->username : '' }}"
                                                        class="form-control" id="floatingName" placeholder="Your Name"
                                                        readonly>
                                                    <label for="floatingName">Your Username</label> --}}
                                                    </div>
                                                </div>
                                                <!-- End floating Labels Form -->

                                                <div class="col-md-12">
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            value="{{ $user->profile->description ?? '' }}"
                                                            class="form-control" id="floatingPassword"
                                                            placeholder="Password" readonly>
                                                        <label for="floatingPassword">Description</label>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            @foreach ($data['rows'] as $user)
                <div class="modal fade" id="user-{{ $user->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">
                                    <h2 class="card-title">Edit</h2>
                                </h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="card-body">


                                    <!-- Floating Labels Form -->
                                    <form action="{{ route($base_route . 'update', $user->id) }}" method="POST"
                                        class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" value="{{ isset($user) ? $user->name : '' }}"
                                                    class="form-control" id="floatingName" placeholder="Your Name"
                                                    readonly>
                                                <label for="floatingName">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" value="{{ isset($user) ? $user->email : '' }}"
                                                    class="form-control" id="floatingEmail" placeholder="Your Email"
                                                    readonly>
                                                <label for="floatingEmail">Your Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" value="{{ isset($user) ? $user->password : '' }}"
                                                    class="form-control" id="floatingPassword" placeholder="Password"
                                                    readonly>
                                                <label for="floatingPassword">Password</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="user_role" class="form-select" id="floatingSelect"
                                                    aria-label="State">
                                                    </option>
                                                    <option value="1" @selected($user->user_role == '1')>Admin</option>
                                                    <option value="0" @selected($user->user_role == '0')>User</option>

                                                </select>
                                                <label for="floatingSelect">User Role</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="is_banned" class="form-select" id="floatingSelect"
                                                    aria-label="State">
                                                    <option value="1" @selected($user->is_banned == '1')>Banned</option>
                                                    <option value="0" @selected($user->is_banned == '0')>Unban</option>
                                                </select>
                                                <label for="floatingSelect">Banned/Unban</label>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form><!-- End floating Labels Form -->

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="col-lg-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Create Admin</h5>

                    <!-- Floating Labels Form -->
                    <form action="{{ route('admin_create.store') }}" method="POST" id="main_form" class="row g-3 main_form">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control name" id="floatingName"
                                    placeholder="Your Name">
                                {{-- <span class="text-danger">{{ $errors->first('name') }}</span> --}}
                                <label for="floatingName">Full Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="username" class="form-control username" id="floatingName"
                                    placeholder="Username">
                                {{-- <span class="text-danger">{{ $errors->first('username') }}</span> --}}
                                <label for="floatingName">Username</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control email" id="floatingEmail"
                                    placeholder="Your Email">
                                {{-- <span class="text-danger">{{ $errors->first('email') }}</span> --}}
                                <label for="floatingEmail"> Email</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="password" value="12345" class="form-control password"
                                    id="floatingPassword" placeholder="12345" readonly>
                                <label for="floatingPassword">Default Password</label>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End floating Labels Form -->

                </div>
            </div>

        </div>

    </div>
@endsection

@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/general.js') }}"></script>
@endpush
