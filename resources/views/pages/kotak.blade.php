@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Daftar Kotak'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 ">
                    <h6>List Kotak P3K</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="row">
                        @foreach ($kotaks as $index => $kotak)
                            @if ($index % 3 == 0 && $index != 0)
                                </div><div class="row mt-4">
                            @endif
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                        <a href="javascript:;" class="d-block">
                                            <img src="{{ asset('storage/usser_pictures/first_aid_kit_Logo.jpg') }}"
                                                 class="img-fluid border-radius-lg">
                                        </a>
                                    </div>
                                    <div class="card-body pt-2">
                                        <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">Kotak P3K</span>
                                        <a href="{{ route('isi_kotak.detail', $kotak->id) }}"
                                           class="card-title h5 d-block text-darker">
                                            {{ $kotak->nama_kotak }}
                                        </a>
                                        <div class="author align-items-center">
                                            {{-- <div class="name ps-3">
                                                <span>Mathew Glock</span>
                                                <div class="stats">
                                                    <small>Posted on 28 February</small>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
