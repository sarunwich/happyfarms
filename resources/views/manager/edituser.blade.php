@extends('layouts.manager')
@push('style')
    <style>
        .file-input {
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .file-input input[type=file] {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-input .button {
            display: inline-block;
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('build/assets/dist/css/adminlte.min.css') }}">
@endpush
@section('content')
    {{ $staff->id }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ข้อมูลผู้ดำเนินงานในฟาร์ม {{ $staff->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/home">Home</a></li>
                        <li class="breadcrumb-item active">ข้อมูลผู้ดำเนินงานในฟาร์ม {{ $staff->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">แก้ไขข้อมูลผู้ดำเนินงานในฟาร์ม </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" >
                <form id="quickForm" action="{{ route('manager.staffupdate',$staff->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input name="staffid" value="{{ $staff->id }}" type="hidden">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="InputName">ชื่อ</label>
                            <input type="text" name="name" value="{{$staff->name}}" class="form-control" id="InputName"
                                placeholder="กรอกข้อมูลชื่อ">
                        </div>
                        <div class="form-group">
                            <label for="address">ที่อยู่</label>
                            <input type="text" name="address" value="{{$staff->address}}" class="form-control" id="address"
                                placeholder="กรอกข้อมูลที่อยู่">
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>เบอร์โทร</label>
                                    <input type="text" name="phone" value="{{$staff->phone}}" class="form-control" maxlength="10"
                                        placeholder="เบอร์โทร ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ภาพ</label>
                                    <div class="custom-file">
                                        <img src="{{ asset('storage/picture/'.$staff->picture) }}" width="200px">
                                        <input type="file" accept="image/*" class="custom-file-input" name="image"
                                            id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                        {{-- <input type="file" id="fileInput" >
                                    <input type="text" id="filename" placeholder="Choose a filexx" readonly> --}}


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ตำแหน่ง/หน้าที่</label>
                                    <input type="text" name="role" value="{{$staff->role}}" class="form-control"
                                        placeholder="ตำแหน่ง/หน้าที่ ...">
                                </div>
                            </div>
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
    <script src="{{ asset('build/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- jQuery -->
    {{-- <script src="{{ asset('build/assets/plugins/jquery/jquery.min.js') }}"></script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('build/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('build/assets/dist/js/adminlte.min.js') }}"></script>
    {{-- <script src="{{ asset('build/assets/dist/js/demo.js')}}"></script> --}}
    <script>
        function confirmDelete(id) {
            Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this farm!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
        }

        // Handle success response
        @if (session('success'))
            Swal.fire("Success!", "{{ session('success') }}", "success");
        @endif



        $(function() {
            $.validator.setDefaults({
                submitHandler: function(form) {
                    // alert("Form successful submitted!");
                    var formData = new FormData($('#quickForm')[0]);

                    formData.append('image', $('input[type=file]')[0].files[0]);
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Handle success response using SweetAlert
                             console.log(response);
                            // alert("Form successful submitted!");
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success'
                            }).then((result) => {
                                // Redirect to index page after the user clicks OK in SweetAlert
                                if (result.isConfirmed || result.isDismissed) {
                                    window.location.href =
                                        '/manager/adduser/' + response
                                        .id; // Replace '/index' with your actual index page URL
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
            $.validator.addMethod("imageSize", function(value, element) {
                // Check if the element is an input[type=file]
                if (element.type === "file") {
                    // Get the file size
                    var fileSize = element.files[0].size; // Size in bytes
                    // Convert bytes to megabytes
                    var maxSize = 5 * 1024 * 1024; // 5 MB
                    return fileSize <= maxSize;
                }
                return true; // Skip validation if element is not a file input
            }, "Please select an image smaller than 5 MB.");
            $.validator.addMethod("phoneUS", function(phoneNumber, element) {
                phoneNumber = phoneNumber.replace(/\s+/g, "");
                return this.optional(element) || phoneNumber.length > 9 && phoneNumber.match(/^\d{10}$/);
            }, "Please specify a valid phone number");
            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    address: {
                        required: true,

                    },

                    phone: {
                        required: true,
                        phoneUS: true
                    },
                    // image: {
                    //     required: true,
                    //     accept: "image/*", // Ensure the file is an image
                    //     imageSize: true // Custom validation for image size
                    // },
                    role: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "กรุณากรอกชื่อ",
                    },
                    address: {
                        required: "กรุณากรอกที่อยู่",
                    },
                    phone: {
                        required: "กรุณากรอกหมายเลขโทรศัพท์",
                        phoneUS: "Please enter a valid US phone number (10 digits)"
                    },
                    // image: {
                    //     required: "Please select an image",
                    //     accept: "Please select a valid image file",
                    //     imageSize: "Please select an image smaller than 5 MB."
                    // },
                    role: {
                        required: "กรุณาระบุตำแหน่ง/หน้าที่",
                    },


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
        $('#image').on('change', function(e) {
            //get the file name
            // var fileName = $(this).val();
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endpush

