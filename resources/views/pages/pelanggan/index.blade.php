@extends('layout')

@section('menu-pelanggan-active', 'active')
@section('content')
<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Aksi</th>
        </tr>
    </thead>
        @foreach ($pelanggans as $index => $pelanggan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pelanggan->nama }}</td>
                <td>{{ $pelanggan->alamat }}</td>
                <td>{{ $pelanggan->no_telp }}</td>
                <td>
                    <button class="btn btn-sm btn-warning">Edit</button>
                    <button class="btn btn-sm btn-danger">hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection