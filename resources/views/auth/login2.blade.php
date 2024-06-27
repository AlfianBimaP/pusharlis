@extends('layouts.app')

@section('content')
    
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('{{asset('img/Logo_Login1.jpg')}}'); background-position: center;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome to!</h1>
                        <p class="text-lead text-white">Pusharlis P3K Management System.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Login</h5>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('login.perform') }}">
                                @csrf
                                <div class="flex flex-col mb-3">
                                    <input type="email" placeholder="Email" name="email"
                                        class="form-control form-control-lg" value="{{ old('email') ?? 'admin@argon.com' }}"
                                        aria-label="Email">
                                    @error('email')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="password" placeholder="Password" name="password"
                                        class="form-control form-control-lg" aria-label="Password" value="secret">
                                    @error('password')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                                    {{-- <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button> --}}
                                </div>
                                {{-- <p class="text-sm mt-3 mb-0">Belum punya akun? Segera Hubungin admin</p> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">Belum punya akun? Segera Hubungin admin</p>
                </div>
            </div>
        </div>
    </footer>
@endsection
