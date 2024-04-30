@extends('layouts.farm')
@section('title')
    {{ $farm->name }} @parent
@endsection
@section('phone')
    {{ $farm->phone }} @parent
@endsection
@push('style')
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        #map {
            height: 500px;
            width: 600px;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <p class="section-title bg-white text-center text-primary px-3">ติดต่อเรา</p>
                    <h1 class="mb-5">หากคุณมีข้อสงสัยใดๆ โปรดติดต่อเรา</h1>
                </div>
                <div class="row g-5">
                    {{-- <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">Need a functional contact form?</h3>
                    <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 250px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary rounded-pill py-3 px-5" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div> --}}
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        <h3 class="mb-4">รายละเอียดการติดต่อ</h3>
                        <div class="d-flex border-bottom pb-3 mb-3">
                            <div class="flex-shrink-0 btn-square bg-secondary rounded-circle">
                                <i class="fa fa-map-marker-alt text-body"></i>
                            </div>
                            <div class="ms-3">
                                <h6>ออฟฟิศของเรา</h6>
                                <span>{{ $farm->address }}</span>
                            </div>
                        </div>
                        <div class="d-flex border-bottom pb-3 mb-3">
                            <div class="flex-shrink-0 btn-square bg-secondary rounded-circle">
                                <i class="fa fa-phone-alt text-body"></i>
                            </div>
                            <div class="ms-3">
                                <h6>โทรหาเรา</h6>
                                <span>{{ $farm->phone }}</span>
                            </div>
                        </div>
                        {{-- <div class="d-flex border-bottom-0 pb-3 mb-3">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle">
                            <i class="fa fa-envelope text-body"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Mail Us</h6>
                            <span>info@example.com</span>
                        </div>
                    </div> --}}
                        <div id="map"></div>
                        {{-- <iframe class="w-100 rounded"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                            frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
     function initMap() {
	var mapOptions = {
	  center: {lat: {{$farm->lat}}, lng: {{$farm->long}}},
	  zoom: 15,
	}
		
	var maps = new google.maps.Map(document.getElementById("map"),mapOptions);
	
	var marker = new google.maps.Marker({
	   position: new google.maps.LatLng({{$farm->lat}}, {{$farm->long}}),
	   map: maps,
	   title: '{{$farm->name}}'
	});
}
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK3RgqSLy1toc4lkh2JVFQ5ipuRB106vU&callback=initMap" async defer></script>
@endpush
