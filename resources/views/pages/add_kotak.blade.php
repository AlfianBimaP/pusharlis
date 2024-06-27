@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Kotak P3K'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Add Kotak P3K</h6>
                    <hr>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        <span class="alert-icon"><i class="fa fa-warning"></i></span>
                                        <span class="alert-text"><strong>Danger!</strong> {{ $error }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <ul>

                                <li>
                                    <span class="alert-icon"><i class="ni ni-like"></i></span>
                                    <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                                </li>

                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form id="addkotakForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('kotak_p3k.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="inputusername" class="col-form-label">Username</label>
                            <div>
                                <input type="text" class="form-control" id="inputusername" placeholder="Input Username"
                                    name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="px-1 pt-2">
                                <button type="submit" class="btn btn-success btn-sm" id="submitButton">Submit</button>
                                <a href="{{ route('kotak_p3k.index') }}">
                                    <button class="btn btn-danger btn-sm" type="button">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure to Submit?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="confirmSubmit">Save changes</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('submitButton').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form dikirim
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        });

        document.getElementById('confirmSubmit').addEventListener('click', function() {
            console.log("Form will be submitted");
            document.getElementById('addkotakForm').submit(); // Mengirim form
        });
    </script>
@endsection
