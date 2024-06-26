<!DOCTYPE html>
<html>

<head>
    <title>Print Data</title>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>

<body onload="printPage()">
    {{-- <h1>Selected Data</h1> --}} 
    {{-- <h1>{{ $lot_id }}</h1> --}}
    <table border="1">
      
        <tbody>
           
            @php

                $total = count($selectedData);
            @endphp
            @for ($i = 0; $i < $total; $i++)
                {{-- เริ่มแถวใหม่ทุก 4 รายการ --}}
                @if ($i % 4 == 0)
                    <tr >
                @endif
                <td align="center" valign="bottom">
                    @php
                        $part = url('') . '/viewqr/' . $lot_id;
                    @endphp
                    <div class="container">
                        {{ QrCode::size(200)->generate($part) }}
                    </div>
                    <div >{{$lot_id}}/{{ $selectedData[$i] }}</div>
                </td>
                {{-- <td>{{ $item->name }}</td>
                    <td>{{ $item->details }}</td> --}}
                @if ($i + (1 % 4) == 0 || $i == $total)
                    </tr>
                @endif
            @endfor
        </tbody>
    </table>
    <button onclick="window.print()">Print</button>
</body>

</html>
