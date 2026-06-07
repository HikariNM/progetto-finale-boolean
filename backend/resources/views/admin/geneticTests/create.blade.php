@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4" style="max-width: 850px; margin: 0 auto;">
        <a href="{{ route('admin.genetic-test.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            Annulla e torna al registro
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4" style="max-width: 850px; margin: 0 auto;">
        <div class="mb-4">
            <h2 class="fw-bold text-dark m-0">Registra un nuovo test gentico</h2>
            <p class="text-muted m-0">Registra un nuovo test genetico disponibile per i cani</p>
        </div>

            <form action="{{ route('admin.genetic-test.store') }}" method="POST" >
                @csrf

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Nome Test Genetico</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @error('name') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Descrizione test genetico / Nome Intero</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                
                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <button type="button" class="btn btn-light rounded-pill">Annulla</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Salva Test Genetico</button>
                </div>
            </form>
    </div>
</div>
@endsection