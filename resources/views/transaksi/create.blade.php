@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Form Transaksi</h1>
    </div>

    <form action="{{ route('transaksi.createOrUpdate') }}" method="POST">
        @csrf

        <input type="text" name="id" value="{{ $transaksi->id ?? '' }}" hidden>

        <div class="mb-3">
            <label for="user_id" class="form-label">Anggota</label>
            <select class="form-select" aria-label="Select anggota" id="user_id" name="user_id">
                <option default>Pilih anggota</option>
                @foreach ($anggota as $a)
                    <option value="{{ $a->id }}" {{ collect($transaksi->user_id ?? old('user_id'))->contains($a->id) ? 'selected' : '' }}>
                        {{ $a->name }}</option>
                @endforeach
            </select>

            @error('user_id')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="buku_id" class="form-label">Buku</label>
            <select class="form-select" aria-label="Select buku" id="buku_id" name="buku_id">
                <option default>Pilih buku</option>
                @foreach ($bukus as $b)
                    <option value="{{ $b->id }}" {{ collect($transaksi->buku_id ?? old('buku_id'))->contains($b->id) ? 'selected' : '' }}>
                        {{ $b->judul }}</option>
                @endforeach
            </select>

            @error('buku_id')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" aria-label="Select status" id="status" name="status">
                <option value="dipinjam">Dipinjam</option>
                <option value="dikembalikan">Dikembalikan</option>
            </select>

            @error('status')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input name="tanggal_pinjam" type="date" class="form-control" id="tanggal_pinjam"
                value="{{ $transaksi->tanggal_pinjam ?? old('tanggal_pinjam') }}" disabled>

            @error('tanggal_pinjam')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input name="tanggal_kembali" type="date" class="form-control" id="tanggal_kembali"
                value="{{ $transaksi->tanggal_kembali ?? old('tanggal_kembali') }}" disabled>

            @error('tanggal_kembali')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
            <input name="tanggal_pengembalian" type="date" class="form-control" id="tanggal_pengembalian"
                value="{{ $transaksi->tanggal_pengembalian ?? old('tanggal_pengembalian') }}">

            @error('tanggal_pengembalian')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="denda" class="form-label">Denda</label>
            <input name="denda" type="number" class="form-control" id="denda"
                value="{{ $transaksi->denda ?? old('denda') }}" disabled>

            @error('denda')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan">{{ $transaksi->keterangan ?? old('keterangan') }}</textarea>

            @error('keterangan')
                <div class="invalid-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
