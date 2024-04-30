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
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/codemirror/theme/monokai.css') }}">
@endpush
@section('content')
    {{ $id }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ข้อมูลสินค้าในฟาร์ม {{ $farm->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/home">Home</a></li>
                        <li class="breadcrumb-item active">ข้อมูลสินค้าในฟาร์ม {{ $farm->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">เพิ่มข้อมูลสินค้าในฟาร์ม {{ $farm->name }}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="quickForm" action="{{ route('manager.addproductdb') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input name="farmid" value="{{ $id }}" type="hidden">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="InputName">ชื่อสินค้า</label>
                            <input type="text" name="product_name" class="form-control" id="InputName"
                                placeholder="กรอกข้อมูลชื่อ">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ประเภทสินค้า</label>
                                    <select name="type_id" class="form-control select2" style="width: 100%;">
                                        @foreach ($types as $key => $type)
                                            <option @if ($key == 0) selected="selected" @endif
                                                value="{{ $type->id }}">{{ $type->type_name }}
                                            </option>
                                        @endforeach
                                        {{-- <option selected="selected">Alabama</option> --}}

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ลักษณะการบรรจุ</label>
                                    <select name="packaging_id" class="form-control select2" style="width: 100%;">
                                        @foreach ($packagings as $key => $packaging)
                                            <option @if ($key == 0) selected="selected" @endif
                                                value="{{ $packaging->id }}">{{ $packaging->packaging_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>จำนวน</label>
                                    <input type="number" name="unit" class="form-control" placeholder="จำนวน ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ขนาด</label>
                                    <select name="size_id" class="form-control select2" style="width: 100%;">
                                        @foreach ($sizes as $key => $size)
                                            <option @if ($key == 0) selected="selected" @endif
                                                value="{{ $size->id }}">{{ $size->size_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ภาพ</label>
                                    <div class="custom-file">

                                        <input type="file" accept="image/*" class="custom-file-input" name="image"
                                            id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>



                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="details">รายละเอียด</label>
                                    <textarea id="summernote" class="form-control" cols="3" name="details"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="recommen">คำแนะนำเกี่ยวกับวิธีการเก็บรักษา และการบริโภค</label>
                                    <textarea id="summernote_recommen" class="form-control" cols="3" name="recommen"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="information">ข้อมูลสุขภาพและโภชนาการ มาตรฐานคุณภาพ</label>
                                    <textarea id="summernote_information" class="form-control" cols="3" name="information"></textarea>
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ข้อมูลผู้ดำเนินงานในฟาร์ม {{ $farm->name }}</h3>

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
                            <th></th>
                            <th>ชื่อสินค้า</th>
                            <th scope="col">ประเภทสินค้า</th>
                            <th scope="col">ลักษณะการบรรจุ</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">ขนาด</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($farm->products) --}}
                        @foreach ($farm->products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>

                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar"
                                                src="{{ asset('storage/products/' . $product->picture) }}">
                                        </li>
                                    </ul>

                                </td>

                                <td> {{ $product->product_name }}</td>
                                <td> {{ $product->type->type_name }} </td>
                                <td> {{ $product->packaging->packaging_name }} </td>
                                <td> {{ $product->unit }} </td>
                                <td> {{ $product->size->size_name }} </td>

                                <td> 
                                    <input type="checkbox"
                                    id="myCheck" onchange="changstatus('{{ $product->status }}','{{ $product->id }}')"
                                        name="my-checkbox{{ $product->id }}" @if ($product->status == 1) checked @endif
                                        data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                </td>
                                {{-- <td> {{ $staff->address }}</td> --}}
                                <td>
                                    <a class="btn btn-info btn-sm"
                                        onclick="window.location='{{ route('manager.editstaff', ['id' => $product->id]) }}'"
                                        href="#">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <form id="delete-form-{{ $product->id }}"
                                        action="{{ route('product.destroy', ['id' => $product->id, 'farm_id' => $farm->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="confirmDelete('{{ $product->id }}')"
                                            class="btn btn-danger btn-sm"> <i class="fas fa-trash">
                                            </i>Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
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
    <!-- Select2 -->
    <script src="{{ asset('build/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('build/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('build/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('build/assets/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

    <!-- Bootstrap Switch -->
    <script src="{{ asset('build/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    <script>
        function changstatus(status, id) {
            // alert(id)
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('upstatus') }}",
                type: 'POST',
                data: {
                    status: status,
                    id: id,
                    // Add more key-value pairs as needed
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                },
                success: function(response) {
                    console.log(response);
                    // Handle the response data here
                },
                error: function(xhr, status, error) {
                    // Handle errors
                }
            });
        }

        function confirmDelete(id) {

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                    // Swal.fire({
                    //     title: "Deleted!",
                    //     text: "Your file has been deleted.",
                    //     icon: "success"
                    // });
                }
            });

            // Swal.fire({
            //         title: "Are you sure?",
            //         text: "Once deleted, you will not be able to recover this user!",
            //         icon: "warning",
            //         buttons: ["Cancel", "Delete"],
            //         dangerMode: true,
            //     })
            //     .then((willDelete) => {
            //         if (willDelete) {
            //             document.getElementById('delete-form-' + id).submit();
            //         } else {
            //             Swal.fire("Your user is safe!", {
            //                 icon: "success",
            //             });
            //         }
            //     });
        }

        // Handle success response
        @if (session('success'))
            // Swal.fire("Success!", "{{ session('success') }}", "success");
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });
        @endif



        $(function() {
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
                
            })
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#summernote').summernote()
            $('#summernote_recommen').summernote()
            $('#summernote_information').summernote()

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
                                        '/manager/addproduct/' + response
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
                    product_name: {
                        required: true,
                    },
                    type_id: {
                        required: true,

                    },

                    packaging_id: {
                        required: true,
                    },
                    image: {
                        required: true,
                        accept: "image/*", // Ensure the file is an image
                        imageSize: true // Custom validation for image size
                    },
                    unit: {
                        required: true,
                    },
                    size_id: {
                        required: true,
                    },
                    recommen: {
                        required: true,
                    },
                    information: {
                        required: true,
                    },
                    details: {
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
                    image: {
                        required: "Please select an image",
                        accept: "Please select a valid image file",
                        imageSize: "Please select an image smaller than 5 MB."
                    },
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
