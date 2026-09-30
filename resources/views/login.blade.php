@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Login</h1>
            </div>
            <form action="{{ route('authenticate') }}" method="POST">
                @csrf

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

                <div class="footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
