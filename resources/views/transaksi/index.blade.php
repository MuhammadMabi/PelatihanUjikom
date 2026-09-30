@extends('layouts.app')

@section('content')
    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Transaksi</h1>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>
    </div>

    <div class="table table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Anggota</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Tanggal Pengembalian</th>
                    <th scope="col">Denda</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $t)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $t->user->name }}</td>
                        <td>{{ $t->buku->judul }}</td>
                        <td>{{ $t->status }}</td>
                        <td>{{ $t->tanggal_pinjam }}</td>
                        <td>{{ $t->tanggal_kembali }}</td>
                        <td>{{ $t->tanggal_pengembalian }}</td>
                        <td>{{ $t->denda }}</td>
                        <td>{{ $t->keterangan }}</td>
                        <td>
                            <form action="{{ route('transaksi.delete', [$t->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <a href="{{ route('transaksi.edit', [$t->id]) }}" class="btn btn-success">Edit</a>
                                @if ($t->status == 'dipinjam')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure to delete this transaksi?')">Delete</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
