<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}
        @section('title')  @show
    </title>
    
    <meta content="" name="farm">
    <meta content="" name="description">

    @include('include.head')
    @stack('style')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    @include('include.topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('include.navbar')
    <!-- Navbar End -->


    <!-- Page Header Start -->
    @yield('content')
        

    <!-- Footer Start -->
    @include('include.footer')
    <!-- Footer End -->


    <!-- Copyright Start -->
    @include('include.copyright')
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    @include('include.footerjs')
    @stack('scripts')
</body>

</html>