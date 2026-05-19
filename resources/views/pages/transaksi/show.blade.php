@extends('layouts.app')

@section('menu-transaksi-active')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
            <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            <p><strong>Pelanggan:</strong> {{ $transaksi->pelanggan?->nama ?? '-' }}</p>
            <p><strong>Tgl Masuk:</strong> {{ $transaksi->tgl_masuk }}</p>
            <p><strong>Tgl Diambil:</strong> {{ $transaksi->tgl_diambil }}</p>
            <p><strong>Status Bayar:</strong> {{ $transaksi->status_bayar }}</p>

            <h6>Detail Items</h6>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Layanan</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi->details as $i => $d)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $d->layanan?->nama_layanan ?? '-' }}</td>
                            <td>{{ $d->qty }}</td>
                            <td>{{ $d->subtotal }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada item</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
