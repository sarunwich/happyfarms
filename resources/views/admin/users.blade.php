@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ผู้ใช้</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/home">Home</a></li>
                        <li class="breadcrumb-item active">user</li>
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
                <h3 class="card-title">ข้อมูลผู้ใช้</h3>

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
                            <th scope="col">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td scope="row">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    {{-- {{ $user->type }} --}}
                                    <select name="status" id="status{{ $user->id }}"
                                        onchange="upstatustype({{ $user->id }})" class="form-control ">
                                        <option value="">สถานะ</option>
                                        <option value="0" @if (old('status', $user->type) == 'user') selected @endif>
                                            ผู้ใช้</option>
                                        <option value="1" @if (old('status', $user->type) == 'admin') selected @endif>
                                            ผู้ดูแลระบบ</option>
                                        <option value="2" @if (old('status', $user->type) == 'manager') selected @endif>
                                            ผู้จัดการระบบ</option>
                                       

                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $users->links() !!}
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
@push('scripts')
<script>
function upstatustype(id) {

    var status = document.getElementById("status" + id);
    var st = status.value;
      //alert(id);
    // var status = 0;
    // if (checkBox.checked == true) {

    //     status = 1;
    // } else {

    //     status = 0;
    // }
    $.ajax({
        url: "{{ url('/admin/UpstatusType') }}",
        method: 'post',
        data: {
            "_token": "{{ csrf_token() }}",
            id: id,
            type: parseInt(st),
        },
        success: function(result) {
            console.log(result);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 2500
            }).then(function() {
                        // window.location = "redirectURL";
                        // window.setTimeout(function() {}, 1500);
                        location.reload();
                    });
            // window.setTimeout(function(){ } ,5500);
            //     location.reload();
        }
    });

}
</script>
@endpush