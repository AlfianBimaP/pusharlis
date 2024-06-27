@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data P3K'])
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Add Items</h6>
                    <hr>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form id="addItemsForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('data_p3k.update', $items->id) }}">
                        @csrf
                        <div class="form-group ">
                            <label for="itemName" class="col-sm-1 col-form-label">Item Name</label>
                            <div class="col-sm-14">
                                <input type="text" class="form-control" id="itemName" name="itemName"
                                    placeholder="Input Item Name" value="{{ $items->item_name }}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="inputQuantity" class="col-sm-1 col-form-label">Quantity</label>
                            <div class="col-sm-14">
                                <input type="number" class="form-control" id="inputQuantity" placeholder="Input Quantity"
                                    name="quantity" value="{{ $items->quantity }}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="inputExp" class="col-sm-1 col-form-label">EXP. Date</label>
                            <div class="col-sm-14">
                                <input type="date" class="form-control" id="inputExp" name="exp_date"
                                    placeholder="Input EXP. Date" value="{{ $items->exp_date }}">
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
                                <a href="{{ route('data_p3k.index') }}"><button class="btn btn-danger btn-sm"
                                        type="button">Cancel</button></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Submit Add Itmes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure to Submit ?
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
        document.addEventListener('DOMContentLoaded', function() {
            // Set default value for EXP. Date to today's date
            var today = new Date();
            var yyyy = today.getFullYear();
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            var dd = String(today.getDate()).padStart(2, '0');
            var todayDate = yyyy + '-' + mm + '-' + dd;
            document.getElementById('inputExp').value = todayDate;
        });

        // Menangani klik tombol submit
        document.getElementById('addItemsForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form dikirim

            // Menampilkan modal
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        });

        // Handle confirm submit button click in modal
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.getElementById('addItemsForm').submit(); // Submit the form
            console.log();
        });
    </script>
@endsection
