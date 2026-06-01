@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="mb-4">
        <a href="{{ route('admin.adults.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            Annulla e torna al registro
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4" style="max-width: 850px; margin: 0 auto;">
        <div class="mb-4">
            <h2 class="fw-bold text-dark m-0">Registra Nuova Cucciolata</h2>
            <p class="text-muted m-0">Registra un nuovo accoppiamento programmato o una nascita avvenuta</p>
        </div>

        <form action="{{ route('admin.litters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Titolo / Identificativo Cucciolata</label>
                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Es: Cucciolata 'A'">
                @error('title') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="birth_date" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Data di Nascita</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                    @error('birth_date') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="status" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Stato del Ciclo</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="In programma" {{ old('status') == 'In programma' ? 'selected' : '' }}>In programma</option>
                        <option value="Nata" {{ old('status') == 'Nata' ? 'selected' : '' }}>Nata</option>
                        <option value="Svezzata" {{ old('status') == 'Svezzata' ? 'selected' : '' }}>Svezzata</option>
                    </select>
                    @error('status') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row border-top pt-3 mt-2">
                <div class="col-md-6 mb-4">
                    <label for="mother_id" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Madre (Fattrice Interna)</label>
                    <select class="form-select @error('mother_id') is-invalid @enderror" id="mother_id" name="mother_id">
                        <option value="">-- Seleziona la fattrice --</option>
                        @foreach($mothers as $mother)
                            <option value="{{ $mother->id }}" {{ old('mother_id') == $mother->id ? 'selected' : '' }}>{{ $mother->name }}</option>
                        @endforeach
                    </select>
                    @error('mother_id') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="father_id" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Padre (Stallone Interno)</label>
                    <select class="form-select @error('father_id') is-invalid @enderror" id="father_id" name="father_id">
                        <option value="">-- Seleziona lo stallone dell'allevamento --</option>
                        @foreach($fathers as $father)
                            <option value="{{ $father->id }}" {{ old('father_id') == $father->id ? 'selected' : '' }}>{{ $father->name }}</option>
                        @endforeach
                    </select>
                    @error('father_id') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-4 bg-light p-3 rounded border" id="external_father_wrapper" style="display: none;">
                <label for="external_father_name" class="text-uppercase fs-7 text-dark fw-bold mb-2 d-block">
                    <i class="fa-solid fa-code-fork me-1 text-muted"></i> Dettagli Stallone Esterno
                </label>
                <input type="text" class="form-control bg-white @error('external_father_name') is-invalid @enderror" id="external_father_name" name="external_father_name" value="{{ old('external_father_name') }}" placeholder="Inserisci Nome Cane ed eventuale Allevamento di provenienza">
                <div class="form-text small text-muted">Compila questo campo solo se l'accoppiamento è avvenuto con un maschio esterno.</div>
                @error('external_father_name') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4 border-top pt-3">
                <label for="description" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Note e Note Storiche</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Inserisci dettagli sull'andamento della gravidanza, ecografie o info sul parto...">{{ old('description') }}</textarea>
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
        
                @if(isset($litter) && $litter->image_path)
                    <div class="mt-3 pt-3 border-top text-center">
                        <p class="small text-muted mb-2 fw-semibold">Foto attuale:</p>
                        <img src="{{ asset('storage/' . $litter->image_path) }}" alt="Foto {{ $litter->name }}" class="img-thumbnail shadow-sm" style="max-height: 150px; object-fit: cover;">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <a href="{{ route('admin.litters.index') }}" class="btn btn-light rounded-pill px-4">Annulla</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Salva Cucciolata</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fatherSelect = document.getElementById('father_id');
        const externalWrapper = document.getElementById('external_father_wrapper');

        function toggleExternalField() {
            if (fatherSelect.value === "") {
                externalWrapper.style.display = 'block';
            } else {
                externalWrapper.style.display = 'none';
            }
        }

        fatherSelect.addEventListener('change', toggleExternalField);
        toggleExternalField();
    });
</script>
@endsection