@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data P3K'])
    <div class="row mt-4 mx-4">

        <!-- Kolom untuk Request Obat -->
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 justify-content-between align-items-center">
                    <h6>Request Obat</h6>
                    <!-- Form Filter -->
                    <div class="d-flex">
                        <form method="GET" action="{{ route('history.index') }}" class="form-inline d-flex">
                            <div class="form-group mr-2 d-flex align-items-center">
                                <label for="month" class="mr-2 mb-0">Bulan:</label>
                                <select name="month" id="month" class="form-control">
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}"
                                            {{ request('month', $currentMonth) == $month ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2 d-flex align-items-center">
                                <label for="year" class="mr-2 mb-0">Tahun:</label>
                                <select name="year" id="year" class="form-control">
                                    @foreach (range(date('Y'), 2000) as $year)
                                        <option value="{{ $year }}"
                                            {{ request('year', $currentYear) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Filter</button>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                        PJ</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kotak P3K</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Item Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Quantity</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestItems as $request)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $request->user->username }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $request->kotak->nama_kotak }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $request->datap3ks->item_name }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $request->quantity }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $request->tanggal }}</p>
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
