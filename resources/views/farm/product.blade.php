@extends('layouts.farm')
@section('title')
    {{ $farm->name }} @parent
@endsection
@section('phone')
    {{ $farm->phone }} @parent
@endsection
@push('style')
@endpush
@section('content')
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Products</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Our Products</p>
                <h1 class="mb-5">ผลิตภัณฑ์ของเราเพื่อสุขภาพที่ดี</h1>
            </div>
            <div class="row gx-4">
                @foreach ($farm->products as $key => $product)
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-item">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset('storage/products/' . $product->picture) }}" alt="">
                                <div class="product-overlay">
                                    <a class="btn btn-square btn-secondary rounded-circle m-1" href=""><i
                                            class="bi bi-link"></i></a>
                                    <a class="btn btn-square btn-secondary rounded-circle m-1" href=""><i
                                            class="bi bi-cart"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4">
                                <a class="d-block h5" href="">{{$product->product_name}}</a>
                                <span class="text-primary me-1">{{$product->packaging->packaging_name}}</span>
                                <span class="text-primary me-1">{{$product->unit}}</span>
                                <span class="text-primary me-1">{{$product->size->size_name}}</span>
                                <span class="text-primary me-1">${{$product->price}}</span>

                                {{-- <span class="text-decoration-line-through">$29.00</span> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
@endsection
