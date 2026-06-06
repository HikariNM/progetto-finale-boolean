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

    <form action="{{ route('admin.adults.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            
            <div class="col-12 col-md-8">
                <div class="card shadow-sm border-0 p-4 mb-4">
                    <h4 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-id-card me-2"></i>Dati Principali</h4>
                    
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="form-label fw-semibold">Nome del Cane *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Es: Thor" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="breed" class="form-label fw-semibold">Razza *</label>
                            <input type="text" class="form-control @error('breed') is-invalid @enderror" id="breed" name="breed" value="{{ old('breed') }}" placeholder="Es: Australian Shepherd" required>
                            @error('breed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="gender" class="form-label fw-semibold">Genere *</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="" selected disabled>Seleziona il genere...</option>
                                <option value="Maschio" {{ old('gender') === 'Maschio' ? 'selected' : '' }}>Maschio</option>
                                <option value="Femmina" {{ old('gender') === 'Femmina' ? 'selected' : '' }}>Femmina</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="birth_date" class="form-label fw-semibold">Data di Nascita *</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="coat_color" class="form-label fw-semibold">Colore Mantello</label>
                            <select class="form-select @error('coat_color') is-invalid @enderror" id="coat_color" name="coat_color" required>
                                <option value="" selected disabled>Seleziona il colore del mantello...</option>
                                <option value="Black Tricolor" {{ old('coat_color') === 'Black Tricolor' ? 'selected' : '' }}>Black Tricolor</option>
                                <option value="Red Tricolor" {{ old('coat_color') === 'Red Tricolor' ? 'selected' : '' }}>Red Tricolor</option>
                                <option value="Blue Merle" {{ old('coat_color') === 'Blue Merle' ? 'selected' : '' }}>Blue Merle</option>
                                <option value="Red Merle" {{ old('coat_color') === 'Red Merle' ? 'selected' : '' }}>Red Merle</option>
                            </select>
                            @error('coat_color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="tail_type" class="form-label fw-semibold">Coda</label>
                            <select class="form-select @error('tail_type') is-invalid @enderror" id="tail_type" name="tail_type" required>
                                <option value="" selected disabled>Seleziona la coda...</option>
                                <option value="NBT" {{ old('tail_type') === 'NBT' ? 'selected' : '' }}>NBT</option>
                                <option value="Coda lunga" {{ old('tail_type') === 'Coda lunga' ? 'selected' : '' }}>Coda lunga</option>
                            </select>
                            @error('tail_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="microchip" class="form-label fw-semibold">Codice Microchip </label>
                            <input type="text" class="form-control @error('microchip') is-invalid @enderror" id="microchip" name="microchip" value="{{ old('microchip') }}" placeholder="15 cifre numeriche" maxlength="15">
                            <small class="text-muted d-block mt-1">Deve essere composto da esattamente 15 cifre.</small>
                            @error('microchip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="pedigree_code" class="form-label fw-semibold">Codice Pedigree (Opzionale)</label>
                            <input type="text" class="form-control @error('pedigree_code') is-invalid @enderror" id="pedigree_code" name="pedigree_code" value="{{ old('pedigree_code') }}" placeholder="Es: LOI21XXXXX">
                            @error('pedigree_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="breeder" class="form-label fw-semibold">Allevatore (Opzionale)</label>
                            <input type="text" class="form-control @error('breeder') is-invalid @enderror" id="breeder" name="breeder" value="{{ old('breeder', $adult->breeder) }}" >
                            @error('breeder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="owner" class="form-label fw-semibold">Proprietario (Opzionale)</label>
                            <input type="text" class="form-control @error('owner') is-invalid @enderror" id="owner" name="owner" value="{{ old('owner', $adult->owner) }}" >
                            @error('owner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label fw-semibold">Descrizione (Opzionale)</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Inserisci una breve descrizione del cane con le sue caratteristiche.">{{ old('description') }}</textarea>
                        </div>

                        <div id="genetic-tests-wrapper">
                            <h4 class="form-label fw-semibold">Test Genetici (Opzionale)</h4>
                            @foreach ($geneticTests as $geneticTest)
                                <div class="test-row mb-2 row">
                                    <div class="col-auto">
                                        <input type="checkbox" name="geneticTest[]" value="{{$geneticTest->id}}" class="toggle-test form-check-input" id="check-{{$geneticTest->id}}">
                                        <label class="form-check-label" for="check-{{$geneticTest->id}}">{{$geneticTest->name}}</label>
                                    </div>
                                    <div class="details-div d-none col">
                                        <div class="row g-2">
                                            <div class="col-auto">
                                                <input type="date" class="form-control form-control-sm d-inline" name="test_date[{{$geneticTest->id}}]" disabled>
                                            </div>
                                            <div class="col-auto">
                                                {{-- <input type="text" class="form-control form-control-sm d-inline" name="result[{{$geneticTest->id}}]" placeholder="Risultato" disabled> --}}
                                            <select name="result[{{$geneticTest->id}}]"  class="form-control form-control-sm d-inline @error('result.' . $geneticTest->id) is-invalid @enderror" id="result[{{$geneticTest->id}}]">
                                                <option value="" selected disabled>Risultato test...</option>
                                                <option value="Clear" {{ old('result.' . $geneticTest->id) === 'Clear' ? 'selected' : '' }}>Clear</option>
                                                <option value="Affected" {{ old('result.' . $geneticTest->id) === 'Affected' ? 'selected' : '' }}>Affected</option>
                                                <option value="Carrier" {{ old('result.' . $geneticTest->id) === 'Carrier' ? 'selected' : '' }}>Carrier</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                                    <input type="text" class="form-control" name="titles[]" value="{{ $oldTitle }}" placeholder="Es: Campione Italiano di Bellezza 2025">
                                    <button class="btn btn-outline-danger remove-title-btn" type="button"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card shadow-sm border-0 p-4 mb-4">
                    <h4 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-sliders me-2"></i>Stato in Allevamento</h4>

                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold">Stato Attuale *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Attivo" {{ old('status', 'Attivo') === 'Attivo' ? 'selected' : '' }}>Attivo (Riproduttore)</option>
                            <option value="Ritirato" {{ old('status') === 'Ritirato' ? 'selected' : '' }}>Ritirato / Pensionato</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="is_neutered" name="is_neutered" value="1" {{ old('is_neutered') ? 'checked' : '' }}>
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
            
                    @if(isset($adult) && $adult->image_path)
                        <div class="mt-3 pt-3 border-top text-center">
                            <p class="small text-muted mb-2 fw-semibold">Foto attuale:</p>
                            <img src="{{ asset('storage/' . $adult->image_path) }}" alt="Foto {{ $adult->name }}" class="img-thumbnail shadow-sm" style="max-height: 150px; object-fit: cover;">
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
        const geneticWrapper = document.getElementById('genetic-tests-wrapper');

        /**
         * 
         * Appends a new input field row when the "Aggiungi Titolo" button is clicked.
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
         *  INPUT REMOVAL (Event Delegation)
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
         *  Neutered Switch -> Status Select
         * If the user marks the dog as "Sterilizzato" (Neutered), the breeding status 
         * automatically switches to "Ritirato" (Retired) since neutered dogs cannot breed
         */
        isNeuteredCheckbox.addEventListener('change', function () {
            if (this.checked) {
                statusSelect.value = 'Ritirato';
            }
        });

        /**
         *  Status Select -> Neutered Switch (Bidirectional Control)
         * Reversing the choice: If the status is manually set back to "Attivo"
         * the "Sterilizzato" switch is forced back to false (unchecked)
         */
        statusSelect.addEventListener('change', function () {
            if (this.value === 'Attivo') {
                isNeuteredCheckbox.checked = false;
            }
        });

        geneticWrapper.addEventListener('change', function(e) {
        if (e.target.classList.contains('toggle-test')) {
        const row = e.target.closest('.test-row');
        const detailsDiv = row.querySelector('.details-div');

                if (e.target.checked) {
                    detailsDiv.classList.remove('d-none');
                    detailsDiv.classList.add('d-inline');
                    detailsDiv.querySelectorAll('input').forEach(input => input.disabled = false);
                } else {
                    detailsDiv.classList.remove('d-inline');
                    detailsDiv.classList.add('d-none');
                    detailsDiv.querySelectorAll('input').forEach(input => input.disabled = true);
                }
            }
        }); 
    });
</script>
@endsection