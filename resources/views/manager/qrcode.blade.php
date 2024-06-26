@extends('layouts.manager')
@push('style')
    <script language="javascript" type="text/javascript">
        function printWindow() {
            var printReadyEle = document.getElementById("printContent");
            var shtml = '<HTML>\n<HEAD>\n';
            if (document.getElementsByTagName != null) {
                var sheadTags = document.getElementsByTagName("head");
                if (sheadTags.length > 0)
                    shtml += sheadTags[0].innerHTML;
            }
            shtml += '</HEAD>\n<BODY>\n';
            if (printReadyEle != null) {
                shtml += '<form name = frmform1>';
                shtml += printReadyEle.innerHTML;
            }
            shtml += '\n</form>\n</BODY>\n</HTML>';
            var printWin1 = window.open();
            printWin1.document.open();
            printWin1.document.write(shtml);
            printWin1.document.close();
            printWin1.print();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select-all').click(function() {
                var checked = this.checked;
                $('input[type="checkbox"]').each(function() {
                    this.checked = checked;
                });
            });

            $('input[type="checkbox"]').click(function() {
                if (!this.checked) {
                    $('#select-all').prop('checked', false);
                }

                var allChecked = $('input[type="checkbox"]:not(#select-all)').length === $('input[type="checkbox"]:not(#select-all):checked').length;
                $('#select-all').prop('checked', allChecked);
            });
            // $('#print-button').click(function(e) {
            //     e.preventDefault();
            //     var form = $('#data-form');
            //     var selected = $('input[name="selected[]"]:checked').length;

            //     if (selected > 0) {
            //         // var newTab = window.open('', '_blank');
            //         // form.attr('target', newTab.name);
            //         form.submit();
            //     } else {
            //         alert('Please select at least one item to print.');
            //     }
            // });
            // Handle form submission and open in new tab
            $('#print-form').submit(function(e) {
                e.preventDefault();
                var selected = $('input[name="selected[]"]:checked').map(function() {
                    return $(this).val();
                }).get();

                var lot_id = $('input[name="lot_id"]').map(function() {
                    return $(this).val();
                }).get();

                if (selected.length > 0) {
                    var url = "{{ route('data.print') }}";
                    var form = $('<form>', {
                        'action': url,
                        'method': 'POST',
                        'target': '_blank'
                    }).append($('<input>', {
                        'name': '_token',
                        'value': '{{ csrf_token() }}',
                        'type': 'hidden'
                    }));

                    selected.forEach(function(id) {
                        form.append($('<input>', {
                            'name': 'selected[]',
                            'value': id,
                            'type': 'hidden'
                        }));
                    });
                    lot_id.forEach(function(id) {
                        form.append($('<input>', {
                            'name': 'lot_id',
                            'value': id,
                            'type': 'hidden'
                        }));
                    });

                    form.appendTo('body').submit().remove();
                } else {
                    alert('Please select at least one item to print.');
                }
            });
        });
    </script>
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
                <strong> รอบการผลิตที่::</strong> {{ $lot->id }} <br>
                <strong> ผลิตเอง::</strong> {{ number_format($lot->myself) }} {{ $products->type->classifier }}<br>
                <strong> รับซื้อ::</strong>{{ number_format($lot->receive) }} {{ $products->type->classifier }}<br>
                <strong>จำนวนรวม::</strong> {{ number_format($lot->receive + $lot->myself) }}
                {{ $products->type->classifier }}<br>
                <strong> จำนวนสิ้นค้า::</strong> {{ number_format(($lot->receive + $lot->myself) / $products->unit) }}
                {{ $products->packaging->packaging_name }} <br>
                <strong>วันที่บรรจุ::</strong> {{ $lot->packing_date }}<br>
                <strong>วันที่หมดอายุ::</strong> {{ $lot->Expiration_date }}<br>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">QR {{ $products->product_name }} รอบการผลิตที่ :: {{ $lot->id }}</h3>

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
                @php
                    $total = number_format(($lot->receive + $lot->myself) / $products->unit);
                @endphp
                {{-- {{ $total }} 
                <input type="button" value="Print" onclick="printWindow();"> --}}
                <div id="printContent">
                    {{-- <form id="print-form" action="{{ route('data.print') }}" method="POST"> --}}
                        <form id="print-form" >
                        @csrf
                        <input name="lot_id" type="hidden" value="{{ $lot->id }}">
                        <table border="1">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"> Select All</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @for ($i = 0; $i < $total; $i++)
                                    {{-- เริ่มแถวใหม่ทุก 4 รายการ --}}
                                    @if ($i % 4 == 0)
                                        <tr>
                                    @endif


                                    {{-- แสดงข้อมูล --}}
                                    <td>
                                        <input type="checkbox" name="selected[]" value="{{ $i + 1 }}">
                                        <!-- นี่คือส่วนที่คุณแสดงข้อมูล อาจจะใส่ HTML ตามต้องการ -->
                                        {{-- @php $idqr=url('').'/viewqr/'.$lot->id; @endphp
                                {!! QrCode::size(200)->generate($idqr) !!}{{ $i + 1 }} --}}
                                        @php
                                            $part = url('') . '/viewqr/' . $lot->id;
                                        @endphp
                                        <div class="container">
                                            {{ QrCode::size(200)->generate($part) }}
                                        </div>
                                        <div>{{ $lot->id }}/{{ $i + 1 }}</div>
                                        <div class="codesource-link">
                                            <a href="{{ $part }}" target="_blank">{{ $part }}</a>
                                        </div>
                                    </td>

                                    {{-- ปิดแถวหลังจากแสดง 4 คอลัม --}}
                                    @if ($i + (1 % 4) == 0 || $i == $total)
                                        </tr>
                                    @endif
                                @endfor
                            </tbody>
                        </table>
                        <button id="print-button" type="submit">Print Selected</button>
                    </form>
                </div>
            </div>
        </div>


    </section>
@endsection
