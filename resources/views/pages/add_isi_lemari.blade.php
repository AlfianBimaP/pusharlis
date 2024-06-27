@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data P3K'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Add Items</h6>
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
                    <form id="addItemsForm" enctype="multipart/form-data" method="POST" action="{{ route('lemari.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="userName" class="col-sm-1 col-form-label">UserName</label>
                            <div class="col-sm-14">
                                <input type="text" class="form-control" id="userName" name="userName" value="{{ Auth::user()->username }}" readonly>
                            </div>

                            <label for="itemName" class="col-sm-1 col-form-label">Item Name</label>
                            <div class="col-sm-14">
                                <select class="form-control" id="itemName" name="itemName">
                                    <option value="">Select Item</option>
                                    @foreach($dataP3Ks as $dataP3K)
                                        <option value="{{ $dataP3K->id }}">{{ $dataP3K->item_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('itemName'))
                                    <span class="text-danger">{{ $errors->first('itemName') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputQuantity" class="col-sm-1 col-form-label">Quantity</label>
                            <div class="col-sm-14">
                                <input type="number" class="form-control" id="inputQuantity" placeholder="Input Quantity" name="quantity" min="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputExp" class="col-sm-1 col-form-label">EXP. Date</label>
                            <div class="col-sm-14">
                                <input type="date" class="form-control" id="inputExp" name="exp_date" placeholder="Input EXP. Date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-sm-1 col-form-label">Tanggal</label>
                            <div class="col-sm-14">
                                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukan Tanggal">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="px-1 pt-2">
                                <button type="button" class="btn btn-success btn-sm" id="openModalButton">Submit</button>
                                <a href="{{ route('lemari.index') }}"><button class="btn btn-danger btn-sm" type="button">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit this form?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Yes, Submit</button>
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

            // Menangani klik tombol submit
            document.getElementById('openModalButton').addEventListener('click', function() {
                var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                myModal.show();
            });

            // Handle confirm submit button click in modal
            document.getElementById('confirmSubmit').addEventListener('click', function() {
                document.getElementById('addItemsForm').submit(); // Submit the form
            });
        });
    </script>
@endsection
