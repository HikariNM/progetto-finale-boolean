@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('admin.litters.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            Torna al registro
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4" style="max-width: 850px; margin: 0 auto;">
        <div class="mb-4">
            <h2 class="fw-bold text-dark m-0">Modifica le informazioni del cucciolo <span class="">{{$puppy->name}}</span></h2>
            <p class="text-muted m-0">Modifica le informazioni</p>
        </div>

            <form action="{{ route('admin.puppies.update', $puppy) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block" for="litter_id">Cucciolata di appartenenza</label>
                        <select name="litter_id" class="form-select @error('litter_id') is-invalid @enderror" >
                            @foreach ($litters as $litter)
                            <option value="{{$litter->id}}"{{old('litter_id', $puppy->litter_id) == $litter->id ? 'selected': ''}}>{{$litter->title}}</option>
                            @endforeach
                        </select>
                        @error('litter_id') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Nome</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $puppy->name)}}">
                        @error('name') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Sesso</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                            <option value="Maschio"{{old('gender', $puppy->gender) == 'Maschio' ? 'selected': ''}}>Maschio</option>
                            <option value="Femmina"{{old('gender', $puppy->gender) == 'Femmina' ? 'selected': ''}}>Femmina</option>
                        </select>
                        @error('gender') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="coat_color" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Colore Mantello</label>
                        <select class="form-select @error('coat_color') is-invalid @enderror" id="coat_color" name="coat_color" required>
                            <option value="" selected disabled>Seleziona il ccolore del mantello...</option>
                            <option value="Black Tricolor" {{ old('coat_color', $puppy->coat_color) === 'Black Tricolor' ? 'selected' : '' }}>Black Tricolor</option>
                            <option value="Red Tricolor" {{ old('coat_color', $puppy->coat_color) === 'Red Tricolor' ? 'selected' : '' }}>Red Tricolor</option>
                            <option value="Blue Merle" {{ old('coat_color', $puppy->coat_color) === 'Blue Merle' ? 'selected' : '' }}>Blue Merle</option>
                            <option value="Red Merle" {{ old('coat_color', $puppy->coat_color) === 'Red Merle' ? 'selected' : '' }}>Red Merle</option>
                        </select>
                        @error('coat_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tail_type" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Coda</label>
                        <select class="form-select @error('tail_type') is-invalid @enderror" id="tail_type" name="tail_type" required>
                            <option value="" selected disabled>Seleziona la coda...</option>
                            <option value="NBT" {{ old('tail_type', $puppy->tail_type) === 'NBT' ? 'selected' : '' }}>NBT</option>
                            <option value="Coda lunga" {{ old('tail_type', $puppy->tail_type) === 'Coda lunga' ? 'selected' : '' }}>Coda lunga</option>
                        </select>
                        @error('tail_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Stato Vendita</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="Disponibile"{{old('status', $puppy->status) == 'Disponibile' ? 'selected': ''}}>Disponibile</option>
                            <option value="Prenotato"{{old('status', $puppy->status) == 'Prenotato' ? 'selected': ''}}>Prenotato</option>
                            <option value="Venduto"{{old('status', $puppy->status) == 'Venduto' ? 'selected': ''}}>Venduto</option>
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
                        <input type="hidden" id="remove_image" name="remove_image" value="0">
                    @if(isset($puppy) && $puppy->image)
                        <div class="mt-3 pt-3 border-top text-center" id="preview-image-container">
                            <p class="small text-muted mb-2 fw-semibold">Foto attuale:</p>
                            <img src="{{ asset('storage/' . $puppy->image) }}" alt="Foto {{ $puppy->name }}" class="img-thumbnail shadow-sm" style="max-height: 150px; object-fit: cover;">
                            <div class="mt-2">
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="btn-remove-image">
                                    <i class="fa-solid fa-trash-can me-1"></i> Rimuovi foto attuale
                                </button>
                            </div>
                        </div>
                    @endif
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Descrizione del cucciolo</label>
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