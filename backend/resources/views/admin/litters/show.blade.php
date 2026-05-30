@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="mb-4">
        <a href="{{ route('admin.adults.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            Torna al registro
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 mb-4">
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
                        <p class="text-muted small m-0">Lista dei singoli cuccioli nati da questo accoppiamento.</p>
                    </div>
                    <a href="{{ route('admin.puppies.create', ['litter_id' => $litter->id]) }}" class="btn btn-sm btn-primary shadow-sm px-3">
                        Aggiungi Cucciolo
                    </a>
                </div>
                <div class="card-body p-0 border-top">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary text-uppercase fs-7 border-bottom">
                                <tr>
                                    <th class="ps-4">Nome</th>
                                    <th>Sesso</th>
                                    <th>Colore Mantello</th>
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
                                            <code class="text-dark bg-light px-2 py-1 rounded">{{ $puppy->color }}</code>
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
                                            <a href="{{ route('admin.puppies.edit', $puppy) }}" class="btn btn-sm btn-outline-secondary" title="Modifica Cucciolo">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
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
@endsection