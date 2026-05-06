@extends('layouts.app')

@section('menu-layanan-active')
@section('content')
<h1>Edit Layanan</h1>

<form action="{{ route('layanan.update', $service->id_layanan) }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Layanan</label>
        <input type="text" class="form-control" name="nama_layanan" value="{{ $service->nama_layanan }}" required>
    </div>
    <div class="form-group">
        <label>Harga Persatuan</label>
        <input type="number" min="0" step="100" class="form-control" name="harga_persatuan" value="{{ $service->harga_persatuan }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('layanan.index') }}" class="btn btn-secondary my-2">Cancel</a>
</form>
@endsection