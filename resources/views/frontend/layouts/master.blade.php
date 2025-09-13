<!DOCTYPE html>
<html lang="en">

@include('frontend.includes.header')

<body>

    @include('frontend.includes.navbar')

    @if (Route::is('frontend.index'))
        @include('frontend.includes.slider')
    @endif
    

    <main>
        @yield('content')
    </main>


   @include('frontend.includes.footer')

   @include('frontend.includes.scripts')
</body>

</html>
