@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @method('PUT')
                {{-- csrf token --}}
                @csrf
                <div class="row">
                    <div class="col-12 ">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" value="{{ $customer->name }}"
                            class="form-control">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="{{ $customer->email }}"
                            class="form-control">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="phone_number">Nomor Telepon</label>
                        <input type="text" id="phone_number" name="phone_number" maxlength="12"
                            value="{{ $customer->phone }}" class="form-control">
                        @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                        <small>Isi password jika ingin mengganti</small>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="text-end mt-4">
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-warning">Kembali</a>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
