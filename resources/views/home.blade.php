@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Home</h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('buku.index') }}">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Buku</h5>
                        <p class="card-text">{{ $buku }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('buku.index') }}">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Anggota</h5>
                        <p class="card-text">{{ $anggota }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('buku.index') }}">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi</h5>
                        <p class="card-text">{{ $transaksi }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
