@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Form Buku</h1>
    </div>

    <form action="{{ route('buku.createOrUpdate') }}" method="POST">
        @csrf

        <input type="text" name="id" value="{{ $buku->id ?? '' }}" hidden>

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input name="judul" type="text" class="form-control" id="judul"
                value="{{ $buku->judul ?? old('judul') }}">

            @error('judul')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pengarang" class="form-label">Pengarang</label>
            <input name="pengarang" type="text" class="form-control" id="pengarang"
                value="{{ $buku->pengarang ?? old('pengarang') }}">

            @error('pengarang')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input name="penerbit" type="text" class="form-control" id="penerbit"
                value="{{ $buku->penerbit ?? old('penerbit') }}">

            @error('penerbit')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
            <input name="tanggal_terbit" type="date" class="form-control" id="tanggal_terbit"
                value="{{ $buku->tanggal_terbit ?? old('tanggal_terbit') }}">

            @error('tanggal_terbit')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input name="isbn" type="text" class="form-control" id="isbn"
                value="{{ $buku->isbn ?? old('isbn') }}">

            @error('isbn')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
