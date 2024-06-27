@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Add User</h6>
                    <hr>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form id="addUserForm" enctype="multipart/form-data" method="POST" action="{{ route('add_user.store') }}">
                        @csrf
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName" class="col-form-label"><span>First Name</span></label>
                                    <div>
                                        <input style="border: 3px solid #f0f0f0" type="text"
                                            placeholder="Input First Name" class="form-control" id="firstName"
                                            name="firstname">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName" class="col-form-label"><span>Last Name</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="lastName"
                                            placeholder="Input Last Name" name="lastname">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="inputusername" class="col-form-label">Username</label>
                            <div>
                                <input type="text" class="form-control" id="inputusername" placeholder="Input Username" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-form-label">Email</label>
                            <div>
                                <input type="email" class="form-control" id="inputEmail" placeholder="Input Email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-form-label">Role</label>
                            <div>
                                <select id="role" name="role" class="form-control" style="border: 3px solid #f0f0f0">
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="supervisor">supervisor</option>
                                    <option value="teamP3K">Team P3K</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label">Password</label>
                            <div>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Input Password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="picture" class="col-form-label">Picture</label>
                            <div>
                                <input type="file" class="form-control" id="picture" name="picture">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="px-1 pt-2">
                                <button type="submit" class="btn btn-success btn-sm" id="submitButton">Submit</button>
                                <a href="{{ route('view_user.index') }}">
                                    <button class="btn btn-danger btn-sm" type="button">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            document.getElementById('addUserForm').submit(); // Mengirim form
        });
    </script>
@endsection
