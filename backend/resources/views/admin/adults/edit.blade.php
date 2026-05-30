@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <a href="{{ route('admin.adults.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            Torna al registro
        </a>
        <h1 class="fw-bold text-dark m-0">Registra Nuovo Cane Adulto</h1>
        <p class="text-muted m-0">Inserisci i dati anagrafici e gli eventuali titoli conseguiti.</p>
    </div>

    <form action="{{ route('admin.adults.update', $adult) }}" method="POST" class="needs-validation" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            
            <div class="col-12 col-md-8">
                <div class="card shadow-sm border-0 p-4 mb-4">
                    <h4 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-id-card me-2"></i>Dati Principali</h4>
                    
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="form-label fw-semibold">Nome del Cane *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $adult->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="breed" class="form-label fw-semibold">Razza *</label>
                            <input type="text" class="form-control @error('breed') is-invalid @enderror" id="breed" name="breed" value="{{ old('breed', $adult->breed) }}" required>
                            @error('breed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="gender" class="form-label fw-semibold">Genere *</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="" selected disabled>Seleziona il genere...</option>
                                <option value="Maschio" {{ old('gender', $adult->gender) === 'Maschio' ? 'selected' : '' }}>Maschio</option>
                                <option value="Femmina" {{ old('gender', $adult->gender) === 'Femmina' ? 'selected' : '' }}>Femmina</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="birth_date" class="form-label fw-semibold">Data di Nascita *</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $adult->birth_date) }}" required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="microchip" class="form-label fw-semibold">Codice Microchip </label>
                            <input type="text" class="form-control @error('microchip') is-invalid @enderror" id="microchip" name="microchip" value="{{ old('microchip', $adult->microchip) }}" maxlength="15">
                            <small class="text-muted d-block mt-1">Deve essere composto da esattamente 15 cifre.</small>
                            @error('microchip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="pedigree_code" class="form-label fw-semibold">Codice Pedigree (Opzionale)</label>
                            <input type="text" class="form-control @error('pedigree_code') is-invalid @enderror" id="pedigree_code" name="pedigree_code" value="{{ old('pedigree_code', $adult->pedigree_code) }}" >
                            @error('pedigree_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold text-secondary m-0"><i class="fa-solid fa-trophy me-2 text-warning"></i>Titoli e Campionati</h4>
                        <button type="button" id="add-title-btn" class="btn btn-sm btn-outline-primary">
                            Aggiungi Titolo
                        </button>
                    </div>
                    <p class="text-muted small">Inserisci i titoli conseguiti dal cane nelle esposizioni cinofile. Lascia vuoto se non ne ha.</p>
                    
                    <div id="titles-wrapper">
                        @if(old('titles'))
                            @foreach(old('titles') as $index => $oldTitle)
                                <div class="input-group mb-2 title-row">
                                    <span class="input-group-text bg-light text-warning"><i class="fa-solid fa-award"></i></span>
                                    <input type="text" class="form-control" name="titles[]" value="{{ $oldTitle }}" >
                                    <button class="btn btn-outline-danger remove-title-btn" type="button"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            @endforeach
                        @else
                            @foreach($adult->titles as $title)
                                <div class="input-group mb-2 title-row">
                                    <span class="input-group-text bg-light text-warning"><i class="fa-solid fa-award"></i></span>
                                    <input type="text" class="form-control" name="titles[]" value="{{ $title->name }}">
                                    <button class="btn btn-outline-danger remove-title-btn" type="button"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card shadow-sm border-0 p-4 mb-4">
                    <h4 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-sliders me-2"></i>Stato Allevamento</h4>

                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold">Stato Attuale *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Attivo" {{ old('status', 'Attivo', $adult->status) === 'Attivo' ? 'selected' : '' }}>Attivo (Riproduttore)</option>
                            <option value="Ritirato" {{ old('status', $adult->status) === 'Ritirato' ? 'selected' : '' }}>Ritirato / Pensionato</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="is_neutered" name="is_neutered" value="1" {{ old('is_neutered', $adult->is_neutered) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_neutered">Sterilizzato / Castrato</label>
                    </div>
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
                    @if(isset($adult) && $adult->image)
                        <div class="mt-3 pt-3 border-top text-center" id="preview-image-container">
                            <p class="small text-muted mb-2 fw-semibold">Foto attuale:</p>
                            <img src="{{ asset('storage/' . $adult->image) }}" alt="Foto {{ $adult->name }}" class="img-thumbnail shadow-sm" style="max-height: 150px; object-fit: cover;">
                            <div class="mt-2">
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="btn-remove-image">
                                    <i class="fa-solid fa-trash-can me-1"></i> Rimuovi foto attuale
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Salva 
                    </button>
                    <a href="{{ route('admin.adults.index') }}" class="btn btn-outline-secondary">
                        Annulla
                    </a>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // DOM Elements Selection
        const wrapper = document.getElementById('titles-wrapper');
        const addButton = document.getElementById('add-title-btn');
        const isNeuteredCheckbox = document.getElementById('is_neutered');
        const statusSelect = document.getElementById('status');
        const btnRemove = document.getElementById('btn-remove-image');
        const inputRemove = document.getElementById('remove_image');
        const containerPreview = document.getElementById('preview-image-container');

        /**
         * * Appends a new input field row when the "Aggiungi Titolo" button is clicked.
         * The name="titles[]" syntax groups these inputs into a single PHP array upon submission.
         */
        addButton.addEventListener('click', function () {
            const div = document.createElement('div');
            div.className = 'input-group mb-2 title-row';
            div.innerHTML = `
                <span class="input-group-text bg-light text-warning"><i class="fa-solid fa-award"></i></span>
                <input type="text" class="form-control" name="titles[]" placeholder="Es: Campione Italiano di Bellezza 2025">
                <button class="btn btn-outline-danger remove-title-btn" type="button"><i class="fa-solid fa-trash"></i></button>
            `;
            wrapper.appendChild(div);
        });

        /**
         * INPUT REMOVAL (Event Delegation)
         * Listens to clicks on the wrapper and deletes the specific row if a remove button is triggered.
         * Event delegation is required since these buttons are generated dynamically at runtime.
         */
        wrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-title-btn') || e.target.closest('.remove-title-btn')) {
                const row = e.target.closest('.title-row');
                if (row) {
                    row.remove();
                }
            }
        });

        /**
         * Neutered Switch -> Status Select
         * If the user marks the dog as "Sterilizzato" (Neutered), the breeding status 
         * automatically switches to "Ritirato" (Retired) since neutered dogs cannot breed
         */
        isNeuteredCheckbox.addEventListener('change', function () {
            if (this.checked) {
                statusSelect.value = 'Ritirato';
            }
        });

        /**
         * Status Select -> Neutered Switch (Bidirectional Control)
         * Reversing the choice: If the status is manually set back to "Attivo"
         * the "Sterilizzato" switch is forced back to false (unchecked)
         */
        statusSelect.addEventListener('change', function () {
            if (this.value === 'Attivo') {
                isNeuteredCheckbox.checked = false;
            }
        });

        if (btnRemove && containerPreview) {
            btnRemove.addEventListener('click', function() {
                // 1 Set idden value a 1 (input to delete)
                inputRemove.value = "1";
                // 2 Hide the preview
                containerPreview.style.display = 'none';
            });
        }
    });
</script>
@endsection