<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
    <a href="{{route('viewfarm',$farm->id)}}" class="navbar-brand d-flex align-items-center">
        <h1 class="m-0">@section('title')  @show</h1>
    </a>
    <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{route('viewfarm',$farm->id)}}" class="nav-item nav-link">Home</a>
            {{-- <a href="about.html" class="nav-item nav-link">About</a>
            <a href="service.html" class="nav-item nav-link">Services</a> --}}
            <a href="{{route('product',$farm->id)}}" class="nav-item nav-link">สินค้า</a>
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="gallery.html" class="dropdown-item">Gallery</a>
                    <a href="feature.html" class="dropdown-item">Features</a>
                    <a href="team.html" class="dropdown-item">Our Team</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item active">404 Page</a>
                </div>
            </div> --}}
            <a href="{{route('contact',$farm->id)}}" class="nav-item nav-link">ติดต่อ</a>
        </div>
        <div class="border-start ps-4 d-none d-lg-block">

            <a href="/"  onclick="/" class="btn btn-sm p-0">กลับหน้าหลัก</a>
        </div>
    </div>
</nav>