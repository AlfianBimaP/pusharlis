@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])



    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>List Users</h6>
                    <button type="button" class="btn btn-primary"><a class="text-white" href="{{ route('add_user.add') }}">
                            Add User</a></button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Role
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create Date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                @if ($user->picture)
                                                    <div>
                                                        <img src="{{ asset('storage/' . $user->picture) }}"
                                                            class="avatar me-3" alt="image">
                                                    </div>
                                                @else
                                                    <div>
                                                        <img src="{{ asset('img/profile_picture.jpg') }}" class="avatar me-3" alt="image">
                                                    </div>
                                                @endif
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->username }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->role }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($user->created_at)
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $user->created_at->format('d/m/Y') }}</p>
                                            @else
                                                <p>N/A</p>
                                            @endif


                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a href="{{ route('view_user.detail', $user->id) }}"><button type="button"
                                                        class="btn btn-primary btn-sm">Edit</button></a>
                                                <a href="{{ route('view_user.delete', $user->id) }}"><button type="button"
                                                        class="btn btn-danger btn-sm">Delete</button></a>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upadate User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif --}}
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
        @if (session('success'))
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
            console.log("Form will be submitted");
        @endif
    </script>
@endsection
