@extends('layouts.app')
@section('menu-layanan-active')
@section('content')
<h1>Tambah Layanan</h1>

<form action="{{ route('layanan.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Layanan</label>
        <input type="text" class="form-control" name="nama_layanan" required>
    </div>
    <div class="form-group">
        <label>Harga Persatuan</label>
        <input type="number" min="0" step="1000" class="form-control" name="harga_persatuan" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('layanan.index') }}" class="btn btn-secondary my-2">Cancel</a>
</form>
@endsection