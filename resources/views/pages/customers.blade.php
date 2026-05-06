@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Daftar Pelanggan</h4>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf   
                                    <button type="submit"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                    class="btn btn-danger">Hapus</button>
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
@endsection
