@extends('layouts.app')

@section('menu-pelanggan-active')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Table Pelanggan</h6>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggans as $index => $pelanggan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pelanggan->nama }}</td>
                                <td>{{ $pelanggan->alamat }}</td>
                                <td>{{ $pelanggan->no_telp }}</td>
                                <td class="d-flex gap-1">
                                    <a href="{{ route('pelanggan.edit', $pelanggan->id_pelanggan) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('pelanggan.destroy', $pelanggan->id_pelanggan) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                            class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak ada data!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
