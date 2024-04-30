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
    {{-- <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
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
    </div> --}}
    
   <!-- About Start -->
   <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="section-title bg-white text-center text-primary px-3">Our Products</p>
            <h1 class="mb-5">ผลิตภัณฑ์ของเราเพื่อสุขภาพที่ดี</h1>
        </div>
        <div class="row g-5 align-items-end">
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="{{ asset('storage/products/' . $product->picture) }}" >
                
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="section-title bg-white text-start text-primary pe-3">ผลิตภัณฑ์</p>
                <h1 class="mb-4">{{$product->product_name}}</h1>
                <p class="mb-4"><span class="text-primary me-1">1 {{$product->packaging->packaging_name}}</span>
                    <span class="text-primary me-1">{{$product->unit}} {{$product->type->classifier}}</span>
                    <span class="text-primary me-1">{{$product->size->size_name}}</span>
                    <span class="text-primary me-1">${{$product->price}}</span>
                    <br>
                    <span class="text-primary me-1">วันที่บรรจุ {{$lot->packing_date}}</span><br>
                    <span class="text-primary me-1">ควรบริโภคก่อนวันที่ {{$lot->Expiration_date}}</span>
                </p>
                <span>{!!$product->details!!}</span>
                <div class="row g-5 pt-2 mb-5">
                    <div class="col-sm-6">
                        <img class="img-fluid mb-4" src="img/service.png" alt="">
                        <h5 class="mb-3">ข้อมูลสุขภาพและโภชนาการ มาตรฐานคุณภาพ</h5>
                        <span>{!!$product->information!!}</span>
                    </div>
                    <div class="col-sm-6">
                        <img class="img-fluid mb-4" src="img/product.png" alt="">
                        <h5 class="mb-3">คำแนะนำเกี่ยวกับวิธีการเก็บรักษา และการบริโภค</h5>
                        <span> {!!$product->recommen!!}</span>
                    </div>
                </div>
                {{-- <a class="btn btn-secondary rounded-pill py-3 px-5" href="">Explore More</a> --}}
            </div>
        </div>
    </div>
</div>
<!-- About End -->
@endsection
