@extends('layouts.app')
@section('menu-layanan-active')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Table Layanan</h6>
            <a href="{{ route('layanan.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('layanan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Layanan</label>
                    <input type="text" class="form-control" name="nama_layanan" required>
                </div>
                <div class="form-group">
                    <label>Harga Persatuan</label>
                    <input type="number" min="0" step="1000" class="form-control" name="harga_persatuan"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
