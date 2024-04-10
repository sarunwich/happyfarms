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
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>เพิ่มข้อมูลฟาร์ม</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/home">Home</a></li>
                        <li class="breadcrumb-item active">เพิ่มข้อมูลฟาร์ม</li>
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
                <form id="quickForm" action="{{ route('manager.farmstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="InputName">ชื่อฟาร์ม</label>
                            <input type="text" name="Name" class="form-control" id="InputName"
                                placeholder="กรอกข้อมูลชื่อฟาร์ม">
                        </div>
                        <div class="form-group">
                            <label for="address">ที่อยู่</label>
                            <input type="text" name="address" class="form-control" id="address"
                                placeholder="กรอกข้อมูลที่อยู่">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>LAT</label>
                                    <input type="text" name="lat" id="lat" class="form-control"
                                        placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Long</label>
                                    <input type="text" name="long" id="long" class="form-control"
                                        placeholder="Enter ...">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div> --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>เบอร์โทร</label>
                                    <input type="text" name="phone" class="form-control" maxlength="10"
                                        placeholder="เบอร์โทร ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>ภาพ</label>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" class="custom-file-input" name="image"
                                            id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                        {{-- <input type="file" id="fileInput" >
                                        <input type="text" id="filename" placeholder="Choose a filexx" readonly> --}}


                                    </div>
                                    {{-- <div class="file-input">
                                        <input type="file" id="file" name="file">
                                        <label for="file" class="button">Choose File</label>
                                        <span id="filename"></span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">รายละเอียด</label>
                            <textarea class="form-control" cols="3" name="description" id="description"></textarea>
                        </div>
                        {{-- <div class="form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                <label class="custom-control-label" for="exampleCheck1">I agree to the <a
                                        href="#">terms of service</a>.</label>
                            </div>
                        </div> --}}
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
    <script>
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
                            // console.log(response);
                            // alert("Form successful submitted!");
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success'
                            }).then((result) => {
                                // Redirect to index page after the user clicks OK in SweetAlert
                                if (result.isConfirmed || result.isDismissed) {
                                    window.location.href =
                                        '/manager/farm'; // Replace '/index' with your actual index page URL
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
                    Name: {
                        required: true,
                    },
                    address: {
                        required: true,

                    },
                    lat: {
                        required: true
                    },
                    long: {
                        required: true
                    },
                    phone: {
                        required: true,
                        phoneUS: true
                    },
                    image: {
                        required: true,
                        accept: "image/*", // Ensure the file is an image
                        imageSize: true // Custom validation for image size
                    },
                    description: {
                        required: true,
                    },
                },
                messages: {
                    Name: {
                        required: "กรุณากรอกชื่อฟาร์ม",
                    },
                    address: {
                        required: "กรุณากรอกที่อยู่",
                    },
                    lat: {
                        required: "กรุณากรอกข้อมูล ละติจูด",
                    },
                    long: {
                        required: "กรุณากรอกข้อมูล ลองติจูด",
                    },

                    phone: {
                        required: "กรุณากรอกหมายเลขโทรศัพท์",
                        phoneUS: "Please enter a valid US phone number (10 digits)"
                    },
                    image: {
                        required: "Please select an image",
                        accept: "Please select a valid image file",
                        imageSize: "Please select an image smaller than 5 MB."
                    },
                    description: {
                        required: "กรุณากรอกรายละเอียด",
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
        $('#image').on('change', function(e) {
            //get the file name
            // var fileName = $(this).val();
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        // $(document).ready(function() {
        //     $('#fileInput').change(function() {
        //         var filename = $(this).val().split('\\').pop();
        //         document.getElementByID('fileInput').style.display = "none";
        //         $('#filename').val(filename);
        //     });
        // });
    </script>
@endpush
