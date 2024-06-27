@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'List Items'])
@php
    $lowQuantityItems = $items->filter(function($item) {
        return $item->quantity <= 5;
    });
@endphp
<div class="row mt-4 mx-4">
    <div class="col-12">
        @if (count($itemsExpiringSoon) > 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Attention!</strong> You have items expiring soon:
            <ul>
                @foreach ($itemsExpiringSoon as $item)
                <li>
                    @if ($item->days_until_expiration > 0)
                    {{ $item->item_name }} - Expired in {{ $item->days_until_expiration }} days
                    @else
                    {{ $item->item_name }} - Expired
                    @endif
                </li>
                @endforeach
            </ul>
            <button type="button" style="font-size: 2.0rem; color:red" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif
        @if($lowQuantityItems->isNotEmpty())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">

            <strong> Attention!</strong> 
            You need to purchase this items:
            @foreach ($lowQuantityItems as $item)
                <!-- @if ($item->quantity <= 5) -->
                <ul>
                    <li>{{ $item->item_name }} - Quantity low ( remaining : {{ $item->quantity }} ). </li>
                </ul>
                <!-- @endif -->
            @endforeach
                <button type="button" style="font-size: 2.0rem;color:red"  class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
            </div>
            @endif
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>List Items</h6>
                <a href="/add_items"><button type="button" class="btn btn-primary">Add Items</button></a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Quantity
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    EXP.Date
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
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
                                    <p class="text-sm font-weight-bold mb-0">{{ $item->quantity }}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $item->exp_date }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($item->quantity > 0)
                                    <span class="badge bg-success bg-sm">In Stock</span>
                                    @else
                                    <span class="badge bg-danger bg-sm">Out of Stock</span>
                                    @endif
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        {{-- <a href="{{ route('data_p3k.detail', $item->id) }}"><button class="btn btn-primary btn-sm" type="reset">edit</button></a> --}}
                                        <a href="{{ route('data_p3k.delete', $item->id) }}"><button class="btn btn-danger btn-sm" type="reset">delete</button></a>
                                    </div>
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