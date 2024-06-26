<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    @include('include.admin.head')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    @stack('style')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../admin/home" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../admin/home" class="brand-link">
                <img src="{{ asset('build/assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('build/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">

                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>

                    </div>

                </div> --}}
                <div class="user-panel mt-3 pb-5 mb-3 d-flex">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            
                            
                                {{-- <img src="{{ asset('build/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                                    alt="User Image"> --}}
                           
                            
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('build/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                                    alt="User Image">
                                {{ Auth::user()->name }}
                            </a>
                            

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>



                <!-- SidebarSearch Form -->
                {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-header">จัดการ</li>
                        {{-- <li class="nav-item">
                            <a href="{{route('admin.managuser')}}" class="nav-link {{Route::is('admin.managuser') ? 'active' : ''}}">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    ข้อมูลผู้ใช้
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{route('manager.farm')}}" class="nav-link {{Route::is('manager.farm') ? 'active' : ''}}">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    ข้อมูลฟาร์ม
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manager.addfarm')}}" class="nav-link {{Route::is('manager.addfarm') ? 'active' : ''}}">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    เพิ่มข้อมูลฟาร์ม
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manager.gallery')}}" class="nav-link {{Route::is('manager.gallery') ? 'active' : ''}}">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    เพิ่มข้อมูลภาพฟาร์ม
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manager.users')}}" class="nav-link {{Route::is('manager.users') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-users"></i>
                                {{-- <i class="fa-solid fa-users-gear"></i> --}}
                                <p>
                                    ผู้ดำเนินงานในฟาร์ม
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manager.product')}}" class="nav-link {{Route::is('manager.product') ? 'active' : ''}}">
                                <i class="nav-icon fa fa-shopping-cart"></i>
                                {{-- <i class="fa-solid fa-users-gear"></i> --}}
                                <p>
                                    สินค้า
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manager.lot')}}" class="nav-link {{Route::is('manager.lot') ? 'active' : ''}}">
                                <i class="nav-icon fa fa-cogs"></i>
                                {{-- <i class="fa-solid fa-users-gear"></i> --}}
                                <p>
                                    รอบการผลิต
                                </p>
                            </a>
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        @include('include.admin.footer')
        @stack('scripts')
</body>

</html>
