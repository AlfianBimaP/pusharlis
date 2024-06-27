@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data P3K'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Input Pengguanaan P3K</h6>
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

                    <form id="addItemsForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('input_P3K.store') }}">
                        @csrf
                        <div class="form-group ">
                            <label for="namaPJ" class="col-sm-3 col-form-label">Nama Penanggung Jawab</label>
                            <div class="col-sm-14">
                                <input type="text" class="form-control" id="namaPJ" name="namaPJ"
                                    value="{{ $user->username }}" readonly>
                                @if ($errors->has('namaPJ'))
                                    <span class="text-danger">{{ $errors->first('namaPJ') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="kotak" class="col-sm-2 col-form-label">Kotak P3K</label>
                            <div class="col-sm-14">
                                <select class="form-control" id="kotak" name="kotak">
                                    <option value="">Pilih Kotak P3K</option>
                                    @foreach ($kotaks as $kotak)
                                        <option value="{{ $kotak->id }}">{{ $kotak->nama_kotak }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('kotak'))
                                    <span class="text-danger">{{ $errors->first('kotak') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="namaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-14">
                                <select class="form-control" id="namaBarang" name="namaBarang">
                                    <option value="">Pilih Nama Barang</option>
                                </select>
                                @if ($errors->has('namaBarang'))
                                    <span class="text-danger">{{ $errors->first('namaBarang') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="inputQuantity" class="col-sm-1 col-form-label">Banyak</label>
                            <div class="col-sm-14">
                                <input type="number" class="form-control" id="inputQuantity" name="quantity"
                                    placeholder="Input Quantity" min="0">
                                @if ($errors->has('quantity'))
                                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="keperluan" class="col-sm-2 col-form-label">Keperluan Pemakaian</label>
                            <div class="col-sm-14">
                                <input type="text" class="form-control" id="keperluan" name="keperluan"
                                    placeholder="Masukan Keperluan">
                                @if ($errors->has('keperluan'))
                                    <span class="text-danger">{{ $errors->first('keperluan') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="tanggal" class="col-sm-1 col-form-label">Tanggal</label>
                            <div class="col-sm-14">
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    placeholder="Masukan Tanggal">
                                @if ($errors->has('tanggal'))
                                    <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="px-1 pt-2">
                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                <a href="{{ route('landing.index') }}"><button class="btn btn-danger btn-sm"
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
                    <h5 class="modal-title" id="exampleModalLabel">Submit Add Items</h5>
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
            document.getElementById('tanggal').value = todayDate;
        });

        // Handle kotak selection change
        document.getElementById('kotak').addEventListener('change', function() {
            var kotakId = this.value;
            if (kotakId) {
                fetch(`/kotak/${kotakId}/items`)
                    .then(response => response.json())
                    .then(data => {
                        var namaBarang = document.getElementById('namaBarang');
                        namaBarang.innerHTML = '<option value="">Pilih Nama Barang</option>';
                        data.forEach(item => {
                            var option = document.createElement('option');
                            option.value = item.id;
                            option.text = item.item_name;
                            namaBarang.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('namaBarang').innerHTML = '<option value="">Pilih Nama Barang</option>';
            }
        });

        // Handle form submit
        document.getElementById('addItemsForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from being submitted

            // Show modal
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        });

        // Handle confirm submit button click in modal
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.getElementById('addItemsForm').submit(); // Submit the form
        });
    </script>
@endsection
