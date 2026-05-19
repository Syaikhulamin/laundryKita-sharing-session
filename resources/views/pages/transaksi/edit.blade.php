@extends('layouts.app')

@section('menu-transaksi-active')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Transaksi</h6>
            <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Pelanggan</label>
                        <select name="id_pelanggan" class="form-control" required>
                            <option value="">-- pilih pelanggan --</option>
                            @foreach ($pelanggans as $p)
                                <option value="{{ $p->id_pelanggan }}"
                                    {{ $p->id_pelanggan == $transaksi->id_pelanggan ? 'selected' : '' }}>{{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Tgl Masuk</label>
                        <input type="date" name="tgl_masuk" class="form-control" value="{{ $transaksi->tgl_masuk }}"
                            required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Tgl Diambil</label>
                        <input type="date" name="tgl_diambil" class="form-control" value="{{ $transaksi->tgl_diambil }}"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Status Bayar</label>
                    <select name="status_bayar" class="form-control">
                        <option value="Belum Bayar" {{ $transaksi->status_bayar == 'Belum Bayar' ? 'selected' : '' }}>Belum
                            Bayar</option>
                        <option value="Lunas" {{ $transaksi->status_bayar == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <h6>Detail Barang</h6>
                <table class="table table-sm" id="detail-table">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Qty</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->details as $detail)
                            <tr>
                                <td>
                                    <select name="layanan_id[]" class="form-control">
                                        <option value="">-- pilih layanan --</option>
                                        @foreach ($layanans as $l)
                                            <option value="{{ $l->id_layanan }}"
                                                {{ $l->id_layanan == $detail->id_layanan ? 'selected' : '' }}>
                                                {{ $l->nama_layanan }} ({{ $l->harga_persatuan }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="qty[]" class="form-control" value="{{ $detail->qty }}">
                                </td>
                                <td><button type="button" class="btn btn-sm btn-danger remove-row">-</button></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                <select name="layanan_id[]" class="form-control">
                                    <option value="">-- pilih layanan --</option>
                                    @foreach ($layanans as $l)
                                        <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan }}
                                            ({{ $l->harga_persatuan }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="qty[]" class="form-control" value="1"></td>
                            <td><button type="button" class="btn btn-sm btn-success" id="add-row">+</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.remove-row').forEach(btn => btn.addEventListener('click', e => e.target.closest('tr')
            .remove()));
        document.getElementById('add-row').addEventListener('click', function() {
            const tbody = document.querySelector('#detail-table tbody');
            const row = document.createElement('tr');
            row.innerHTML = `\
                <td>\
                    <select name="layanan_id[]" class="form-control">\
                        <option value="">-- pilih layanan --</option>\
                        @foreach ($layanans as $l)\
                            <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan }} ({{ $l->harga_persatuan }})</option>\
                        @endforeach\
                    </select>\
                </td>\
                <td><input type="number" name="qty[]" class="form-control" value="1"></td>\
                <td><button type="button" class="btn btn-sm btn-danger remove-row">-</button></td>`;
            tbody.appendChild(row);
            tbody.querySelectorAll('.remove-row').forEach(btn => btn.addEventListener('click', e => e.target
                .closest('tr').remove()));
        });
    </script>
@endsection
