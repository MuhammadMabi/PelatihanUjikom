@extends('layouts.app')

@section('content')
    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession
    
    @session('error')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Buku</h1>
        <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
    </div>

    <div class="table table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tanggal Terbit</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $b)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $b->judul }}</td>
                        <td>{{ $b->pengarang }}</td>
                        <td>{{ $b->penerbit }}</td>
                        <td>{{ $b->tanggal_terbit }}</td>
                        <td>{{ $b->isbn }}</td>
                        <td>
                            <form action="{{ route('buku.delete', [$b->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <a href="{{ route('buku.edit', [$b->id]) }}" class="btn btn-success">Edit</a>
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to delete this buku?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
