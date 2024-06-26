@extends('layouts.manager')

@section('content')
<div class="container">
    <h1>Upload New Picture</h1>
    <form action="{{ route('pictures.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            {{session('farm_id');}}
            <label for="title" class="form-label">Title (optional)</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Pictures</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple required>
            <div id="preview" class="mt-3"></div>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
@push('scripts')
<script>
    document.getElementById('images').addEventListener('change', function(event) {
        let preview = document.getElementById('preview');
        preview.innerHTML = '';
        for(let i = 0; i < event.target.files.length; i++) {
            let file = event.target.files[i];
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style = 'width: 150px; margin: 10px;';
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
