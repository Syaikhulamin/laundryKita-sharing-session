@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Table Layanan</h6>
            <a href="{{ route('layanan.create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($layanans as $index => $layanan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $layanan->nama_layanan }}</td>
                                <td>{{ $layanan->harga_persatuan }}</td>
                                <td class="d-flex gap-1">
                                    <a href="{{ route('layanan.edit', $layanan->id_layanan) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('layanan.destroy', $layanan->id_layanan) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                            class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak ada data!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
