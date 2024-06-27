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
            padding: 0.8rem;
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

        .signature {
            text-align: right;
            margin-top: 50px;
            margin-right: 30px;
        }

        .signature div {
            display: inline-block;
            text-align: center;
        }

        .footer {
            display: none;
        }

        .page-break {
            page-break-before: always;
        }
        .small-td {
            font-size: 12px;
            padding: 2px;
            line-height: 0.2;
        }
    </style>
</head>

<body>
    @php
        $chunks = $kotaks->dataP3Ks->chunk(5);
        $rowNumber = 1;
        $currentYear = date('Y');
        $currentDate = date('d-m-Y');
    @endphp


    {{-- @foreach ($chunks as $index => $chunk) --}}
    @foreach ($chunks as $index => $chunk)
        <table class="table custom-table">
            <tbody>
                <tr>
                    < style="width: 10%; align-item:center">
                        <img src="@php echo $pic @endphp" alt="Logo PLN" class="logo-img">
                    </td>
                    <td style="width: 50%; font-size:14px;">
                        <strong>PT. PLN (PERSERO)</strong><br>
                        <strong>PUSAT PEMELIHARAAN KETENAGALISTRIKAN VI</strong><br>
                        Jl. Ngagel Timur No.16, Surabaya 60285<br>
                        e-mail : pusharlis@pln.co.id
                    </td>
                    <td style="width: 35%; text-align: right;">
                        <img src="@php echo $pic1 @endphp" alt="Logo HSE" class="logo-img1">
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="title">FORM PEMERIKSAAN KOTAK P3K</div>


        <table class="table custom-table">
            <tbody>
                <tr>
                    <td style="width: 70%; font-size:16px;">
                        <div>Nomor:</div>
                        <div>Lokasi :{{ $kotaks->nama_kotak }}</div>
                        <div>Tahun : {{ $currentYear }} </div>
                    </td>
                    <td style="width: 25%; text-align: left; border: 1px solid black !important; font-size:12px;">
                        <div>No. Dokumen: </div>
                        <div>Revisi: </div>
                        <div id="tanggal-container">Tanggal: {{ $currentDate }} </div>
                        <div>Halaman: {{ $index + 1 }} dari {{ $chunks->count() }} halaman</div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered custom-table">
            <thead class="small-td">
                <tr>
                    <th scope="col" rowspan="2" style="text-align: center" class="small-td">No</th>
                    <th scope="col" rowspan="2" style="text-align: center" class="small-td">Nama Barang</th>
                    <th scope="col" rowspan="2" style="text-align: center" class="small-td">Satuan</th>
                    <th scope="col" rowspan="2" style="text-align: center" class="small-td">Jumlah</th>
                    <th scope="col" colspan="12" style="text-align: center" class="small-td">Bulan</th>
                    <th scope="col" rowspan="2" style="text-align: center" class="small-td">Nama Petugas</th>
                </tr>
                <tr>
                    <th scope="col">Jan</th>
                    <th scope="col">Feb</th>
                    <th scope="col">Mar</th>
                    <th scope="col">Apr</th>
                    <th scope="col">Mei</th>
                    <th scope="col">Jun</th>
                    <th scope="col">Jul</th>
                    <th scope="col">Agu</th>
                    <th scope="col">Sep</th>
                    <th scope="col">Okt</th>
                    <th scope="col">Nov</th>
                    <th scope="col">Des</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($chunk as $item) --}}
                @foreach ($chunk as $dataP3K)
                    <tr class="small-td">
                        <td class="small-td">{{ $rowNumber++ }}</td>
                        <td class="small-td">{{ $dataP3K->item_name }}</td>
                        <td>Bh</td>
                        <td>
                            @if ($dataP3K->item_name == 'Alkohol')
                                1
                            @elseif($dataP3K->item_name == 'Antiseptic')
                                2
                            @elseif($dataP3K->item_name == 'Perban 5cm')
                                1
                            @elseif($dataP3K->item_name == 'Perban 10cm')
                                2
                            @elseif($dataP3K->item_name == 'Aquades')
                                1
                            @elseif($dataP3K->item_name == 'Betadine')
                                1
                            @elseif($dataP3K->item_name == 'Buku Catatan Daftar Isi')
                                1
                            @elseif($dataP3K->item_name == 'Buku Panduan')
                                1
                            @elseif($dataP3K->item_name == 'Gelas Cuci Mata')
                                1
                            @elseif($dataP3K->item_name == 'Gunting')
                                1
                            @elseif($dataP3K->item_name == 'Kantong Plastik')
                                1
                            @elseif($dataP3K->item_name == 'Kapas')
                                1
                            @elseif($dataP3K->item_name == 'Kasa Steril')
                                20
                            @elseif($dataP3K->item_name == 'Lampu Senter')
                                1
                            @elseif($dataP3K->item_name == 'Masker')
                                1
                            @elseif($dataP3K->item_name == 'Peniti')
                                12
                            @elseif($dataP3K->item_name == 'Perban')
                                2
                            @elseif($dataP3K->item_name == 'Pinset')
                                1
                            @elseif($dataP3K->item_name == 'Plester')
                                2
                            @elseif($dataP3K->item_name == 'Plester Cepat')
                                10
                            @elseif($dataP3K->item_name == 'Sarung Tangan')
                                2
                            @endif
                        </td>
                        {{-- <td>{{ $dataP3K->pivot->quantity }}</td> --}}
                        <td>
                            {{-- @if (($dataP3K->item_name == 'Alkohol' && $dataP3K->pivot->quantity > 5) || ($dataP3K->item_name == 'Perban 10cm' && $dataP3K->pivot->quantity > 5))
                            Yes
                        @else
                            No
                        @endif --}}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{auth()->user()->username }}</td>
                        {{-- <td><img src="@php echo $pic @endphp" alt="Logo PLN" class="logo-img" style="width:25%; align-item:center;"></td> --}}
                        <td></td>
                    </tr>


                    </tr>
                @endforeach
                {{-- @foreach ($chunk as $item)
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>{{ $item->user->username }}</td>
                        <td>{{ $item->datap3ks->item_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->keperluan }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->kotak->nama_kotak }}</td>

                    </tr>
                @endforeach --}}
            </tbody>
        </table>
        
        <div class="signature">
            <div>
                <p>Jabatan</p>
                <p></p>
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
    {{-- 
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach --}}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
