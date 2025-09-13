<!DOCTYPE html>
<html lang="en">

@include('backend.includes.header')

<body>
    @include('backend.includes.navbar')
    @include('backend.includes.sidebar')
    <main id="main" class="main">

        {{-- @include('backend.includes.breadcrumb') --}}

       @yield('content')

    </main>
    @include('backend.includes.footer')
    @include('backend.includes.script');
</body>

</html>
