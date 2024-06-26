@extends('layouts.farm')
@section('title')
    {{ $farm->name }} @parent
@endsection
@section('phone')
    {{ $farm->phone }} @parent
@endsection
@section('content')
    <div class="container">
        <div class="container-xxl py-5">
            {!! $farm->description !!}
        </div>
        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">

                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <p class="section-title bg-white text-center text-primary px-3">Our Team</p>
                    <h1 class="mb-5">ผู้ดำเนินงานในฟาร์ม</h1>
                </div>
                @foreach ($farm->staffs as $key => $value)
                    

                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item rounded p-4">
                                <img class="img-fluid rounded mb-4" src="{{ asset('storage/picture/' . $value->picture) }}" alt="">
                                <h5>{{$value->name}}</h5>
                                <p class="text-primary">{{$value->role}}</p>
                                <div class="d-flex justify-content-center">
                                    {{-- <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                            class="fab fa-instagram"></i></a> --}}
                                </div>
                            </div>
                        </div>
                @endforeach
                {{-- <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded p-4">
                        <img class="img-fluid rounded mb-4" src="img/team-2.jpg" alt="">
                        <h5>Doris Jordan</h5>
                        <p class="text-primary">Veterinarian</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded p-4">
                        <img class="img-fluid rounded mb-4" src="img/team-3.jpg" alt="">
                        <h5>Jack Dawson</h5>
                        <p class="text-primary">Farmer</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Team End -->
    </div>
@endsection
@section('business_hours')
    {{ $farm->business_hours }} @parent
@endsection
