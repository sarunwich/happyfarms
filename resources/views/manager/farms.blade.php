@extends('layouts.manager')
  
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ข้อมูลฟาร์ม</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../admin/home">Home</a></li>
            <li class="breadcrumb-item active">ข้อมูลฟาร์ม</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Title</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        
        <table class="table mt-3">
          <thead>
              <tr>
                  <th>#</th>
                  <th>ชื่อ</th>
                  {{-- <th scope="col">สถานะ</th> --}}
              </tr>
          </thead>
          <tbody>
              @foreach ($farms as $farm)
                  <tr>
                      <td scope="row">
                          {{ ($farms->currentPage() - 1) * $farms->perPage() + $loop->iteration }}</td>
                      {{-- <td>{{ $farm->image }}</td> --}}
                      <td>{{ $farm->name }}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      <div class="d-flex justify-content-center">
          {!! $farms->withQueryString()->links('pagination::bootstrap-5')  !!}
      </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection