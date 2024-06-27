@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data P3K'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 justify-content-between align-items-center">
                <h6>List Items</h6>
                @if (Auth::check() && Auth::user()->role === 'admin')
                <div class="d-flex">
                    <a href="{{ route('isi_kotak.add', $kotak->id) }}"><button type="button" class="btn btn-primary">Add
                            Items</button></a>
                    <!-- <form method="GET" action="{{ route('exportPDF2', $kotak->id ) }}">
                        <button type="submit" class="btn btn-success ml-auto" style="margin-left: 10px;">Export</button>
                    </form> -->
                </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                @if ($kotak->dataP3Ks->isEmpty())
                <p>No items found in this kotak.</p>
                @else
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">EXP.Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kotak->dataP3Ks as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div>
                                            <img src="{{ asset('storage/' . $item->picture) }}" class="avatar me-3" alt="image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->item_name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $item->pivot->quantity }}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $item->pivot->exp_date }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if ($item->pivot->quantity > 0)
                                    <span class="badge bg-success bg-sm">In Stock</span>
                                    @else
                                    <span class="badge bg-danger bg-sm">Out of Stock</span>
                                    @endif
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <form action="{{ route('isi_kotak.destroy', ['kotakId' => $kotak->id, 'dataP3kId' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
