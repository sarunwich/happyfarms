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
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('build/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('build/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>สินค้า {{ $products->product_name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/home">Home</a></li>
                        <li class="breadcrumb-item active">สินค้า{{ $products->product_name }}</li>
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
                <h3 class="card-title">เพิ่มข้อมูลรอบการผลิตสินค้า {{ $products->product_name }}</h3>

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
                <form id="quickForm" action="{{ route('manager.addlotdb') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="pid" value="{{ $products->id }}" type="hidden">
                    <div class="card-body">
                        {{ $id }}
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>รอบการผลิตที่</label>
                                    <input type="text" name="id" value="{{ $id }}" readonly
                                        class="form-control" placeholder="จำนวน ...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">


                                <div class="form-group">
                                    <label for="exampleInputFile">จำนวนที่ผลิตเอง</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="number" id="myself" name="myself" onchange="calltotal();"
                                                value="0" class="form-control" placeholder="จำนวน ...">
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ $products->type->classifier }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                {{-- <div class="form-group">
                                    <label>จำนวนที่รับซื้อ</label>
                                    <input type="number" id="receive" name="receive" onchange="calltotal();"
                                        value="0" class="form-control" placeholder="จำนวน ...">
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputFile">จำนวนที่รับซื้อ</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="number" id="receive" name="receive" onchange="calltotal();"
                                                value="0" class="form-control" placeholder="จำนวน ...">
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ $products->type->classifier }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->


                                <div class="form-group">
                                    <label for="exampleInputFile">จำนวนรวมทั้งหมด</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="number" id="total" name="total" value="0"
                                                class="form-control" placeholder="จำนวน ..." readonly>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ $products->type->classifier }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                {{-- <div class="form-group">
                                    <label>จำนวนสินค้า {{ $products->unit }} {{ $products->type->classifier }} /
                                        {{ $products->packaging->packaging_name }}</label>
                                    <input type="number" id="numproduct" name="numproduct" value="0"
                                        class="form-control" placeholder="จำนวน ...">
                                </div> --}}
                                <input type="hidden" name="unit" value="{{ $products->unit }}">
                                <div class="form-group">
                                    <label for="exampleInputFile">จำนวนสินค้า {{ $products->unit }}
                                        {{ $products->type->classifier }} /
                                        {{ $products->packaging->packaging_name }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="number" id="numproduct" name="numproduct" value="0"
                                                class="form-control" placeholder="จำนวน ..." readonly>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ $products->packaging->packaging_name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่บรรจุ:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="packing_date"
                                            class="form-control datetimepicker-input" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่หมดอายุ:</label>
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="text" name="Expiration_date"
                                            class="form-control datetimepicker-input" data-target="#reservationdate2" />
                                        <div class="input-group-append" data-target="#reservationdate2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- <div class="row">
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ข้อมูลรอบการผลิต {{ $products->product_name }}</h3>

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

                            <th>รอบการผลิตที่</th>
                            <th>ผลิตเอง</th>
                            <th>รับซื้อ</th>
                            <th>จำนวนรวม</th>
                            <th>จำนวนสิ้นค้า</th>
                            <th>วันที่บรรจุ</th>
                            <th>วันที่หมดอายุ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($lots as $key => $lot)
                            <tr align="right">
                                <td>{{ $key + 1 }}</td>
                                {{-- <td>

                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar"
                                                src="{{ asset('storage/products/' . $product->picture) }}">
                                        </li>
                                    </ul>

                                </td> --}}

                                <td> {{ $lot->id }}</td>
                                <td> {{ number_format($lot->myself) }} </td>
                                <td> {{ number_format($lot->receive) }} </td>
                                <td> {{ number_format($lot->receive + $lot->myself) }} </td>
                                <td> {{ number_format(($lot->receive + $lot->myself) / $products->unit) }}
                                    {{ $products->packaging->packaging_name }} </td>
                                <td> {{ $lot->packing_date }} </td>
                                <td> {{ $lot->Expiration_date }} </td>
                                <td><a class="btn btn-info btn-sm"
                                        onclick="window.location='{{ route('manager.qrcode', ['id' => $lot->id]) }}'"
                                        href="#">
                                        <i class="fa fa-qrcode" aria-hidden="true"></i>
QRCode
                                    </a></td>
                                {{-- <td> {{ $product->size->size_name }} </td> --}}

                                {{-- <td> 
                                    <input type="checkbox"
                                    id="myCheck" onchange="changstatus('{{ $product->status }}','{{ $product->id }}')"
                                        name="my-checkbox{{ $product->id }}" @if ($product->status == 1) checked @endif
                                        data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                </td>
                               
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

                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $lots->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    {{-- <!-- jQuery -->
<script src="{{ asset('build/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('build/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{ asset('build/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('build/assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('build/assets/dist/js/adminlte.min.js')}}"></script> --}}
    <!-- jQuery -->
    <script src="{{ asset('build/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('build/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    {{-- <script src="{{ asset('build/assets/dist/js/adminlte.min.js') }}"></script> --}}

    <!-- Select2 -->
    {{-- <script src="{{ asset('build/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('build/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('build/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('build/assets/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script> --}}

    <!-- Bootstrap Switch -->
    <script src="{{ asset('build/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('build/assets/plugins/moment/moment.min.js') }}"></script>

    <!-- date-range-picker -->
    <script src="{{ asset('build/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('build/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>




    <script>
        function calltotal() {
            var input1 = document.getElementById('myself');
            var input2 = document.getElementById('receive');
            var input3 = document.getElementById('total');
            var input4 = document.getElementById('numproduct');
            var input5 = document.getElementById('unit');

            // Get the value of the input element

            var value1 = parseInt(input1.value) || 0; // Parse input1 value to integer or default to 0
            var value2 = parseInt(input2.value) || 0; // Parse input2 value to integer or default to 0

            // Calculate the sum
            var sum = value1 + value2;
            var total = sum / input5;
            // Update input3 with the sum
            input3.value = sum;
            input4.value = Math.floor(total);

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
            //Date picker
            $('#reservationdate').datetimepicker({
                // format: 'L'
                format: 'yyyy-MM-DD'
            });
            $('#reservationdate2').datetimepicker({
                // format: 'L'
                format: 'yyyy-MM-DD'
            });



            $.validator.setDefaults({
                submitHandler: function(form) {
                    // alert("Form successful submitted!");
                    var formData = new FormData($('#quickForm')[0]);

                    // formData.append('image', $('input[type=file]')[0].files[0]);
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
                                    window.location.href = '/manager/viewlot/' +
                                        response
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
                    myself: {
                        required: true,
                    },
                    receive: {
                        required: true,

                    },
                    packing_date: {
                        required: true,
                    },
                    Expiration_date: {
                        required: true,
                    },
                },
                messages: {
                    myself: {
                        required: "ระบุจำนวน",
                    },
                    receive: {
                        required: "ระบุจำนวน",
                    },
                    packing_date: {
                        required: "กรุณากรอกวันที่ผลิต",

                    },
                    Expiration_date: {
                        required: "กรุณากรอกวันที่หมดอายุ",

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
