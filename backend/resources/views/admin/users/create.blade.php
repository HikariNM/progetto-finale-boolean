@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0 p-4" style="max-width: 600px; margin: 0 auto;">
        <h2 class="fw-bold mb-4">Crea Nuovo Utente</h2>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nome</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Conferma Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-pill">Annulla</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Crea Utente</button>
            </div>
        </form>
    </div>
</div>
@endsection