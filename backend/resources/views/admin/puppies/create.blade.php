@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('admin.litters.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            Annulla e torna al registro delle cucciolate
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4" style="max-width: 850px; margin: 0 auto;">
        <div class="mb-4">
            <h2 class="fw-bold text-dark m-0">Registra un nuovo cucciolo</h2>
            <p class="text-muted m-0">Registra un nuovo cucciolo appena nato</p>
        </div>

            <form action="{{ route('admin.puppies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block" for="litter_id">Cucciolata di appartenenza</label>
                        <select name="litter_id" class="form-select @error('litter_id') is-invalid @enderror" >
                            @foreach ($litters as $litter)
                            <option value="{{$litter->id}}" {{old('litter_id', request('litter_id')) == $litter->id ? 'selected': ''}}>{{$litter->title}}</option>
                            @endforeach
                        </select>
                        @error('litter_id') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Nome</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @error('name') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Sesso</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                            <option value="Maschio" {{old('gender') == 'Maschio' ? 'selected': ''}}>Maschio</option>
                            <option value="Femmina" {{old('gender') == 'Femmina' ? 'selected': ''}}>Femmina</option>
                        </select>
                        @error('gender') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Colore Mantello</label>
                        <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{old('color')}}">
                        @error('color') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Stato Vendita</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="Disponibile" {{old('status') == 'Disponibile' ? 'selected': ''}}>Disponibile</option>
                            <option value="Prenotato" {{old('status') == 'Prenotato' ? 'selected': ''}}>Prenotato</option>
                            <option value="Venduto" {{old('status') == 'Venduto' ? 'selected': ''}}>Venduto</option>
                        </select>
                        @error('status') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>
                    <div class="card shadow-sm border-0 p-4 mb-4">
                        <div class="mb-2">
                            <label for="image" class="form-label fw-semibold small text-muted">Seleziona un'immagine (Opzionale)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Formati accettati: JPG, JPEG, PNG. Max 2MB.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Note</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                
                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <button type="button" class="btn btn-light rounded-pill">Annulla</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Salva Cucciolo</button>
                </div>
            </form>
    </div>
</div>
@endsection