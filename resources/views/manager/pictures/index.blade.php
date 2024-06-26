@extends('layouts.manager')
@push('style')
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
@endpush
@section('content')
<div class="container">
    <h1>Your Gallery</h1>
    <a href="{{ route('pictures.create') }}" class="btn btn-primary mb-3">Upload New Picture</a>
    <div class="row">
        @foreach ($pictures as $picture)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $picture->image_path) }}" class="card-img-top" alt="{{ $picture->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $picture->title }}</h5>
                        <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="confirmDelete({{ $picture->id }})"><i class="fas fa-trash-alt"></i></button>
                        <form id="delete-form-{{ $picture->id }}" action="{{ route('pictures.destroy', $picture->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@push('scripts')
  <!-- SweetAlert JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
<script>
    function confirmDelete(pictureId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + pictureId).submit();
            }
        })
    }
    </script>
@endpush
