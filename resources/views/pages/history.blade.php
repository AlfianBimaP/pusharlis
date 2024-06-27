@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data P3K'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0  justify-content-between align-items-center">
                <h6>Penggunaan Obat</h6>
                <div class="d-flex">
                    <form method="GET" action="{{ route('history.index') }}" class="form-inline d-flex">
                        <div class="form-group mr-2 d-flex align-items-center">
                            <label for="month" class="mr-2 mb-0">Bulan:</label>
                            <select name="month" id="month" class="form-control">
                                @foreach (range(1, 12) as $month)
                                <option value="{{ $month }}" {{ request('month', $currentMonth) == $month ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-2 d-flex align-items-center">
                            <label for="year" class="mr-2 mb-0">Tahun:</label>
                            <select name="year" id="year" class="form-control">
                                @foreach (range(date('Y'), 2000) as $year)
                                <option value="{{ $year }}" {{ request('year', $currentYear) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Filter</button>
                    </form>
                    <form method="GET" action="{{ route('exportPDF') }}">
                        <input type="hidden" name="month" value="{{ request('month', $currentMonth) }}">
                        <input type="hidden" name="year" value="{{ request('year', $currentYear) }}">
                        <button type="submit" class="btn btn-success ml-auto">Export</button>
                    </form>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Kotak P3K</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nama Barang</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Jumlah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tanggal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inputItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->user->username }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $item->kotak->nama_kotak }}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $item->datap3ks->item_name }}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $item->quantity }}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0" style="text-align:center;">{{ $item->tanggal }}</p>
                                </td>
                                
                                <td>
                                    <p class="text-sm font-weight-bold mb-0" style="text-align: center;">{{ $item->keperluan }}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection