@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data P3K'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>List Items</h6>
                    <a href="{{ route('kotak_p3k.add') }}"><button type="button" class="btn btn-primary">Add
                            Items</button></a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kotaks as $kotak)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    {{-- <img src="{{ asset('storage/' . $item->picture) }}" class="avatar me-3" alt="image"> --}}
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $kotak->nama_kotak }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $item->quantity }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $item->exp_date }}</p>
                                        </td> --}}
                                        {{-- <td class="align-middle text-center text-sm">
                                            <span class="badge bg-success bg-sm">Active</span>
                                        </td> --}}
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                {{-- <a href="{{ route('data_p3k.detail', $item->id) }}"><button class="btn btn-primary btn-sm" type="reset">edit</button></a> --}}
                                                <a href="{{ route('kotak_p3k.delete', $kotak->id) }}"><button
                                                        class="btn btn-danger btn-sm" type="reset">delete</button></a>
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
