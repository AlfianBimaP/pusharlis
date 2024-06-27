@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'List Items'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Form export Inspeksi</h6>
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
                <form id="addItemsForm" enctype="multipart/form-data" method="GET" action="{{ route('exportPDF2', ':id') }}">
                    @csrf
                    <div class="form-group">
                        <label for="kotak" class="col-sm-1 col-form-label">Pilih Kotak</label>
                        <div class="col-sm-14">
                            <select class="form-control" id="kotak" name="kotak_id">
                                @foreach($kotaks as $kotak)
                                <option value="{{ $kotak->id }}">{{ $kotak->nama_kotak }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="px-1 pt-2">
                            <button type="submit" class="btn btn-success btn-sm" id="submitBtn">Submit</button>
                            <a href="{{ route('data_p3k.index') }}"><button class="btn btn-danger btn-sm" type="button">Cancel</button></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Submit Add Items</h5>
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
    document.getElementById('addItemsForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var kotakId = document.getElementById('kotak').value;
    var form = this;
    var action = form.action.replace(':id', kotakId);
    form.action = action;
    form.submit();
});

</script>
@endsection