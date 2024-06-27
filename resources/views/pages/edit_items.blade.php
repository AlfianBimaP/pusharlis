@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data P3K'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Edit Items</h6>
                    <hr>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form id="editItemsForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName" class="col-form-label"><span>First Name</span></label>
                                    <div>
                                        <input style="border: 3px solid #f0f0f0" type="text"
                                            placeholder="Input First Name" class="form-control-plaintext" id="firstName"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName" class="col-form-label"><span>Last Name</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="lastName"
                                            placeholder="Input Last Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="inputusername" class="col-sm-1 col-form-label">Username</label>
                            <div class="col-sm-14">
                                <input type="text" class="form-control" id="inputusername" placeholder="Input Username">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="inputEmail" class="col-sm-1 col-form-label">Email</label>
                            <div class="col-sm-14">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Input Email">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="role" class="col-sm-1 col-form-label">Role</label>
                            <div class="col-sm-14">
                                <select id="role" name="role" class="form-control"
                                    style="border: 3px solid #f0f0f0">
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                    <option value="user">User</option>
                                    <option value="guest">Guest</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="inputPassword" class="col-sm-1 col-form-label">Password</label>
                            <div class="col-sm-14">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Input Username">
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
                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                <button class="btn btn-info btn-sm" type="reset">Reset</button>
                                <a href="/data_P3K"><button class="btn btn-danger btn-sm" type="button">Cancel</button></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Submit Edited Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure to Submit ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Save changes</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Menangani klik tombol submit
        document.getElementById('editItemsForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form dikirim

            // Menampilkan modal
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        });

        // Menangani klik tombol cancel
        document.getElementById('cancelButton').addEventListener('click', function(event) {
            // Redirect atau lakukan aksi lain sesuai kebutuhan Anda
            console.log('Cancel button clicked');
        });
    </script>
@endsection
