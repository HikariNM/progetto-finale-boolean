@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.litters.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            Torna al registro
        </a>
        <div class="btn-group shadow-sm" role="group">
            <a href="{{ route('admin.litters.edit', $litter) }}" class="btn btn-white border fw-semibold">
                <i class="fa-solid fa-pen text-secondary me-1"></i> Modifica
            </a>
            <button type="button" class="btn btn-white border text-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#deleteAdultModal{{ $litter->id }}">
                <i class="fa-solid fa-trash-can me-1"></i> Elimina
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 mb-4">
                @if($litter->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $litter->image) }}" alt="Foto {{ $litter->name }}" class="img-fluid rounded shadow-sm border" style="max-height: 250px; width: 100%; object-fit: cover;">
                    </div>
                    @endif
                <div class="card-body p-4">
                    <span class="badge @if($litter->status === 'Nata') bg-success @elseif($litter->status === 'Svezzata') bg-info @else bg-warning text-dark @endif rounded-pill px-3 mb-2">
                        {{ $litter->status }}
                    </span>
                    <h2 class="fw-bold text-dark mb-3">{{ $litter->title }}</h2>
                    
                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-muted fw-bold d-block m-0">Data di nascita</label>
                        <span class="fw-semibold text-dark fs-5">{{ \Carbon\Carbon::parse($litter->birth_date)->format('d/m/Y') }}</span>
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-muted fw-bold d-block m-0">Madre Fatttice</label>
                        @if($litter->mother)
                            <a href="{{ route('admin.adults.show', $litter->mother->id) }}" class="fw-bold text-primary text-decoration-none fs-5">
                                <i class="fa-solid fa-venus me-1 text-danger"></i> {{ $litter->mother->name }}
                            </a>
                        @else
                            <span class="fw-semibold text-dark fs-5">{{ $litter->mother_name_backup }}</span>
                            <span class="badge bg-secondary-subtle text-secondary ms-1">Non attiva</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="text-uppercase fs-7 text-muted fw-bold d-block m-0">Padre Stallone</label>
                        @if($litter->father)
                            <a href="{{ route('admin.adults.show', $litter->father->id) }}" class="fw-bold text-primary text-decoration-none fs-5">
                                <i class="fa-solid fa-mars me-1 text-info"></i> {{ $litter->father->name }}
                            </a>
                        @else
                            <span class="fw-semibold text-dark fs-5"><i class="fa-solid fa-paw me-1 text-secondary"></i> {{ $litter->external_father_name }}</span>
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill ms-1 px-2 small">Esterno</span>
                        @endif
                    </div>

                    @if($litter->description)
                        <div class="mt-4 border-top pt-3">
                            <label class="text-uppercase fs-7 text-muted fw-bold d-block mb-1">Note e Note Storiche</label>
                            <p class="text-secondary m-0 bg-light p-3 rounded fs-6">{{ $litter->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold text-dark m-0">Componenti della Cucciolata</h4>
                        <p class="text-muted small m-0">Lista dei singoli cuccioli nati da questo accoppiamento</p>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary shadow-sm px-3" title="Aggiungi" data-bs-toggle="modal" data-bs-target="#addPuppyModal">
                        Aggiungi Cucciolo
                    </button> 
                </div>
                <div class="card-body p-0 border-top">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary text-uppercase fs-7 border-bottom">
                                <tr>
                                    <th class="ps-4">Nome</th>
                                    <th>Sesso</th>
                                    <th>Colore Mantello</th>
                                    <th>Coda</th>
                                    <th>Stato Vendita</th>
                                    <th class="text-center pe-4">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($litter->puppies as $puppy)
                                    <tr>
                                        <td class="fw-bold text-dark ps-4 fs-5">
                                            {{ $puppy->name }}
                                        </td>
                                        <td>
                                            @if($puppy->gender === 'Maschio')
                                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-2">
                                                    <i class="fa-solid fa-mars"></i> Maschio
                                                </span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2">
                                                    <i class="fa-solid fa-venus"></i> Femmina
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <code class="text-dark bg-light px-2 py-1 rounded">{{ $puppy->coat_color }}</code>
                                        </td>
                                        <td>
                                            <code class="text-dark bg-light px-2 py-1 rounded">{{ $puppy->tail_type }}</code>
                                        </td>
                                        <td>
                                            @if($puppy->status === 'Disponibile')
                                                <span class="badge bg-success rounded-pill px-2">Disponibile</span>
                                            @elseif($puppy->status === 'Prenotato')
                                                <span class="badge bg-warning text-dark rounded-pill px-2">Prenotato</span>
                                            @else
                                                <span class="badge bg-secondary rounded-pill px-2">Venduto</span>
                                            @endif
                                        </td>
                                        <td class="text-center pe-4">
                                            <a href="{{ route('admin.puppies.show', $puppy->id) }}" class="btn btn-sm btn-outline-secondary" title="Vedi Dettagli">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.puppies.edit', $puppy) }}" class="btn btn-sm btn-outline-secondary" title="Modifica Cucciolo">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Elimina" data-bs-toggle="modal" data-bs-target="#deletePuppyModal{{ $puppy->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- DELETE PUPPY MODAL --}}
                                    <div class="modal fade" id="deletePuppyModal{{ $puppy->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fw-bold">Elimina Cucciolo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    Sei sicuro di voler eliminare permanentemente il cucciolo <strong>{{ $puppy->name }}</strong>?<br>
                                                    <span class="text-danger fw-semibold"><i class="fa-solid fa-triangle-ex some me-1"></i> Attenzione: Questo eliminerà definitivamente il cucciolo!</span>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Chiudi</button>
                                                    <form action="{{ route('admin.puppies.destroy', $puppy) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger rounded-pill px-4">Elimina</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-baby fa-2x mb-2 text-secondary opacity-50"></i>
                                            <p class="m-0">Nessun cucciolo associato. Clicca sul tasto in alto per censire le nascite.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ADD PUPPY MODAL --}}
<div class="modal fade" id="addPuppyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Aggiungi Nuovo Cucciolo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.puppies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-start">
                    <input type="hidden" name="litter_id" value="{{ $litter->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nome</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sesso</label>
                        <select name="gender" class="form-select" required>
                            <option value="Maschio">Maschio</option>
                            <option value="Femmina">Femmina</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="coat_color" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Colore Mantello</label>
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
                    <div class="mb-3">
                        <label for="tail_type" class="text-uppercase fs-7 text-secondary fw-bold mb-2 d-block">Coda</label>
                        <select class="form-select @error('tail_type') is-invalid @enderror" id="tail_type" name="tail_type" required>
                            <option value="" selected disabled>Seleziona la coda...</option>
                            <option value="NBT" {{ old('tail_type') === 'NBT' ? 'selected' : '' }}>NBT</option>
                            <option value="Coda lunga" {{ old('tail_type') === 'Coda lunga' ? 'selected' : '' }}>Coda lunga</option>
                        </select>
                        @error('tail_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Stato Vendita</label>
                        <select name="status" class="form-select" required>
                            <option value="Disponibile">Disponibile</option>
                            <option value="Prenotato">Prenotato</option>
                            <option value="Venduto">Venduto</option>
                        </select>
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
                        <label class="form-label fw-semibold">Note</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Salva Cucciolo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection