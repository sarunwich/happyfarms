@extends('layouts.admin')
@push('style')
  
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/codemirror/theme/monokai.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endpush
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
                <h3 class="card-title">{{$id}}</h3>

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
                <form id="quickForm" action="{{ route('admin.managerfarm', $id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                       
                        <div class="form-group">
                            <label for="address">ผู้จัดการระบบ</label>
                            <select class="form-control search" id="search"  name="user_id">
                                @foreach($users as $key => $value)
                                    <option value="option1">{{$value->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                      
                        
                       
                        
                           
                        


                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
    $(document).ready(function() {
        var path = "{{ route('autocomplete') }}";
        // Initialize Select2
         $('#search').select2(
    // {
    //     placeholder: 'Select an user',
    //     ajax: {
    //       url: path,
    //       dataType: 'json',
    //       delay: 250,
    //       processResults: function (data) {
    //         return {
    //           results:  $.map(data, function (item) {
    //                 return {
    //                     text: item.name,
    //                     id: item.id
    //                 }
    //             })
    //         };
    //       },
    //       cache: true
    //     }
    //   }
    );
    });
</script>
    <script src="{{ asset('build/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Summernote -->
    <script src="{{ asset('build/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('build/assets/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
   
    <script>
   
        $(function() {
          
            $.validator.setDefaults({
                submitHandler: function(form) {
                    // alert("Form successful submitted!");
                    var formData = new FormData($('#quickForm')[0]);

                    
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Handle success response using SweetAlert
                            // console.log(response);
                            // alert("Form successful submitted!");
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success'
                            }).then((result) => {
                                // Redirect to index page after the user clicks OK in SweetAlert
                                if (result.isConfirmed || result.isDismissed) {
                                    location.reload();
                                //     window.location.href =
                                //         '/manager/farm'; // Replace '/index' with your actual index page URL
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle error response using SweetAlert
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while processing your request.',
                                icon: 'error'
                            });
                        }
                    });
                    return false;
                }
            });
           
            $('#quickForm').validate({
                rules: {
                    Name: {
                        required: true,
                    }
                },
                messages: {
                    Name: {
                        required: "กรุณากรอกชื่อฟาร์ม",
                    }
                    

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
      
       
    </script>
@endpush
