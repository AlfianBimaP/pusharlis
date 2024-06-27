@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-6 ">
                <a href="{{ route('input_P3K.index') }}">
                    <div class="card" style="border: 1px solid #000; border-radius: 14px; background-color: green;">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"
                                            style="color:white;  text-align:center;">Input Pengunanan P3K</p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-6">
                <a href="{{ route('request_P3K.index') }}">
                    <div class="card" style="border: 1px solid #000; border-radius: 14px; background-color:blue; ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"
                                            style="color:white; text-align:center;">Request P3K</p>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>

    </div>
@endsection
