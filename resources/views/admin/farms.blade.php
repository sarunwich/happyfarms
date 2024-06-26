@extends('layouts.admin')
  
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
        
        <table class="table table-striped projects">
          <thead>
              <tr>
                  <th>#</th>
                  <th>ภาพ</th>
                  <th>ชื่อ</th>
                  <th scope="col">ผู้จัดการระบบ</th>
                  <th scope="col">สถานะ</th>
              </tr>
          </thead>
          <tbody>
           
              @foreach ($farms as $farm)
                  <tr>
                      <td scope="row">
                          {{ ($farms->currentPage() - 1) * $farms->perPage() + $loop->iteration }}</td>
                      <td>
                        {{-- @foreach ($farm->staffstf as $staff)
                       @dd($staff->user )
                       @endforeach --}}
                        <img src="{{ asset('storage/images/'.$farm->image) }}" width="100px"></td>
                      <td>{{ $farm->name }}</td>
                      <td>
                        @foreach ($farm->staffstf as $staff)
                       {{$staff->user->name }}
                       @endforeach
                      </td>
                      <td class="project-actions text-right">
                        {{-- <a class="btn btn-primary btn-sm" onclick="window.location='{{ route('manager.viewfarm',['id' => $farm->id]) }}'" href="#">
                          <i class="fas fa-folder">
                          </i>
                          View
                      </a> --}}
                      <a class="btn btn-info btn-sm" onclick="window.location='{{ route('admin.addmanager',['id' => $farm->id]) }}'" href="#">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                      </a>
                        {{-- <button type="button" onclick="window.location='{{ route('manager.viewfarm',['id' => $farm->id]) }}'" class="btn btn-block btn-outline-info">ดู/แก้ไข</button> --}}
                      </td>
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