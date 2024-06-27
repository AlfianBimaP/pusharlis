<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Form Pemakaian Alat P3K</title>
    <style>
        table.table-bordered,
        table.table-bordered th,
        table.table-bordered td {
            border: 1px solid black !important;
            line-height: 0.7rem;
        }

        .custom-table {
            margin-right: 150px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .info {
            font-size: 16px;
        }

        .info .left,
        .info .right {
            margin-bottom: 20px;
            padding: 10px;
        }

        .info .right {
            text-align: left;
            border: 1px solid black;
            border-radius: 5px;
            padding: 10px;
        }

        .logo-img {
            max-width: 70%;
            height: auto;
        }

        .logo-img1 {
            max-width: 15%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: 0;
        }

        .no-whitespace {
            padding: 0 !important;
            margin: 0 !important;
        }

        @page {
            size: A4 landscape;
            margin: 20mm;
        }

        @page {
            @bottom-right {
                content: "Halaman: " counter(page) " dari " counter(pages);
                font-size: 12px;
            }
        }

        .footer {
            display: none;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
            margin-right: 30px;
        }

        .signature div {
            display: inline-block;
            text-align: center;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @php
        $chunks = $inputItems->chunk(6);
        $rowNumber = 1;
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        $currentMonth = $months[(int) date('m')];

    @endphp

    @foreach ($chunks as $index => $chunk)
        <table class="table custom-table">
            <tbody>
                <tr>
                    <td style="width: 10%; align-item:center">
                        <img src="@php echo $pic @endphp" alt="Logo PLN" class="logo-img">
                        {{-- <img src="{{ asset('img/Logo_PLN.png') }}" alt="Logo PLN" class="logo-img"> --}}
                    </td>
                    <td style="width: 50%; font-size:14px;">
                        <strong>PT. PLN (PERSERO)</strong><br>
                        <strong>PUSAT PEMELIHARAAN KETENAGALISTRIKAN VI</strong><br>
                        Jl. Ngagel Timur No.16, Surabaya 60285<br>
                        e-mail : pusharlis@pln.co.id
                    </td>
                    <td style="width: 35%; text-align: right;">
                        <img src="@php echo $pic1 @endphp" alt="Logo HSE" class="logo-img1">
                        {{-- <img src="{{ asset('img/Logo_HSE.png') }}" alt="Logo HSE" class="logo-img1"> --}}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="title">Form Pemakaian Alat P3K</div>

        <table class="table custom-table">
            <tbody>
                <tr>
                    <td style="width: 70%; font-size:16px;">
                        <div>Bulan   : {{ $currentMonth }}</div>
                        <div>Nomor:</div>
                        <div>Lokasi:</div>
                    </td>
                    <td style="width: 25%; text-align: left; border: 1px solid black !important; font-size:12px;">
                        <div>No. Dokumen: </div>
                        <div>Revisi: </div>
                        <div id="tanggal-container">Tanggal: {{ $inputItems->first()->tanggal }}</div>
                        <div>Halaman: {{ $index + 1 }} dari {{ $chunks->count() }} halaman</div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered custom-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Item</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Keperluan Pemakaian</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chunk as $item)
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>{{ $item->user->username }}</td>
                        <td>{{ $item->datap3ks->item_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->keperluan }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->kotak->nama_kotak }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="signature">
            <div>
                <p>Jabatan</p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                {{-- <p>______________________</p> --}}
                <p>Nama Penanggung Jawab</p>
            </div>
        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
