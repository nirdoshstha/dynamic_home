@extends('frontend.layouts.master')

@section('title')
404 Page Not Found
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="">404</h1>
            <h5 class="text-center">Page Not Found</h5>
            <p class="text-center">The page you are looking for does not exist. How you got here is a mystery. <br/>But you can click the button below to go back to the homepage.</p>
            <a href="{{url('/')}}" class="btn btn-outline-success">HOME</a>
        </div>
    </div>
</div>
@endsection
