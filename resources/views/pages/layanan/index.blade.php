@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Daftar Pelanggan</h4>
        <a href="{{ route('layanan.create') }}" class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($layanans as $index => $layanan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $layanan->nama_layanan }}</td>
                            <td>{{ $layanan->harga_persatuan }}</td>
                            <td>
                                <a href="{{ route('layanan.edit', $layanan->id_layanan) }}" class="btn btn-xs btn-warning">Edit</a>
                                <form action="{{ route('layanan.destroy', $layanan->id_layanan) }}" method="POST">
                                    @csrf   
                                    <button type="submit"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                    class="btn btn-xs btn-danger">Hapus</button>
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
@endsection