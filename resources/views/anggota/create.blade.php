@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Form Anggota</h1>
    </div>

    <form action="{{ route('anggota.createOrUpdate') }}" method="POST">
        @csrf

        <input type="text" name="id" value="{{ $anggota->id ?? '' }}" hidden>

        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input name="nik" type="text" class="form-control" id="nik"
                value="{{ $anggota->nik ?? old('nik') }}">

            @error('nik')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="name"
                value="{{ $anggota->name ?? old('name') }}">

            @error('name')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email"
                value="{{ $anggota->email ?? old('email') }}">

            @error('email')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password">

            @error('password')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat">{{ $anggota->alamat ?? old('alamat') }}</textarea>

            @error('alamat')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input name="telepon" type="text" class="form-control" id="telepon"
                value="{{ $anggota->telepon ?? old('telepon') }}">

            @error('telepon')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
