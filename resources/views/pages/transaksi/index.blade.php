@extends('layouts.app')

@section('menu-transaksi-active')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Table Transaksi</h6>
            <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Diambil</th>
                            <th>Status Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $index => $t)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $t->pelanggan?->nama ?? '-' }}</td>
                                <td>{{ $t->tgl_masuk }}</td>
                                <td>{{ $t->tgl_diambil }}</td>
                                <td>{{ $t->status_bayar }}</td>
                                <td class="d-flex gap-1">
                                    <a href="{{ route('transaksi.edit', $t->id_transaksi) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('transaksi.show', $t->id_transaksi) }}"
                                        class="btn btn-sm btn-info">Lihat</a>
                                    <form action="{{ route('transaksi.destroy', $t->id_transaksi) }}" method="POST">
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
                                <td colspan="6">Tidak ada data!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $transaksis->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
