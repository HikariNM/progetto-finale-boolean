@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.adults.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
                Torna al registro
            </a>
            <h1 class="fw-bold text-dark m-0">
                {{ $adult->name }}
                @if($adult->gender === 'Maschio')
                    <span class="text-info fs-3 ms-1"><i class="fa-solid fa-mars"></i></span>
                @else
                    <span class="text-danger fs-3 ms-1"><i class="fa-solid fa-venus"></i></span>
                @endif
            </h1>
            <p class="text-muted m-0">Scheda informativa dettagliata del riproduttore.</p>
        </div>
        
        <div class="btn-group shadow-sm" role="group">
            <a href="{{ route('admin.adults.edit', $adult) }}" class="btn btn-white border fw-semibold">
                <i class="fa-solid fa-pen text-secondary me-1"></i> Modifica
            </a>
            <button type="button" class="btn btn-white border text-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#deleteAdultModal{{ $adult->id }}">
                <i class="fa-solid fa-trash-can me-1"></i> Elimina
            </button>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            
            <div class="card shadow-sm border-0 text-center p-4 mb-4">
                <div class="mb-3">
                    @if($adult->image)
                        <img src="{{ asset('storage/' . $adult->image) }}" alt="Foto {{ $adult->name }}" class="img-fluid rounded shadow-sm border" style="max-height: 250px; width: 100%; object-fit: cover;">
                    @else
                        <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center border" style="height: 200px;">
                            <i class="fa-solid fa-dog fa-3x text-secondary opacity-25 mb-2"></i>
                            <span class="text-muted small italic">Nessuna foto caricata</span>
                        </div>
                    @endif
                </div>
                
                <div class="d-flex justify-content-center gap-2">
                    @if($adult->status === 'Attivo')
                        <span class="badge bg-success rounded-pill px-3 py-2 fw-semibold">Stato: Attivo</span>
                    @else
                        <span class="badge bg-secondary rounded-pill px-3 py-2 fw-semibold">Stato: Ritirato</span>
                    @endif

                    @if($adult->is_neutered)
                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2 fw-semibold">
                            <i class="fa-solid fa-scissors me-1"></i> Sterilizzato
                        </span>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="fw-bold m-0 text-dark"><i class="fa-solid fa-id-card text-primary me-2"></i>Dati Anagrafici</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="text-muted fw-semibold">Razza:</span>
                            <span class="text-dark fw-bold">{{ $adult->breed }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="text-muted fw-semibold">Codice Microchip:</span>
                            <span class="text-dark fw-mono font-monospace fw-bold">{{ $adult->microchip }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="text-muted fw-semibold">Codice Pedigree:</span>
                            <span class="text-dark fw-bold">{{ $adult->pedigree_code ?? 'Nessun Pedigree' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-lg-8">
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-transparent border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold m-0 text-dark">
                        <i class="fa-solid fa-award text-warning me-2"></i>Bacheca Titoli e Trofei
                    </h5>
                    <span class="badge bg-warning text-dark rounded-pill px-3 fw-bold">
                        {{ $adult->titles->count() }} {{ $adult->titles->count() === 1 ? 'Titolo' : 'Titoli' }}
                    </span>
                </div>
                <div class="card-body">
                    @if($adult->titles->count() > 0)
                        <div class="row g-2">
                            @foreach($adult->titles as $title)
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border d-flex align-items-center">
                                        <div class="bg-warning-subtle text-warning rounded p-2 me-3 fs-5">
                                            <i class="fa-solid fa-trophy"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $title->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <p class="m-0 italic small">Nessun titolo o trofeo registrato per questo esemplare.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="fw-bold m-0 text-dark">
                        <i class="fa-solid fa-folder-open text-info me-2"></i>Storico Cucciolate Riprodotte
                    </h5>
                </div>
                <div class="card-body p-0">
                    @php
                        // Recupera le cucciolate in base al genere del cane
                        $relatedLitters = $adult->gender === 'Femmina' ? $adult->littersAsMother : $adult->littersAsFather;
                    @endphp

                    @if($relatedLitters && $relatedLitters->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary fs-7">
                                    <tr>
                                        <th class="ps-4">Titolo Cucciolata</th>
                                        <th>Data Nascita</th>
                                        <th>Stato</th>
                                        <th class="text-end pe-4">Azione</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($relatedLitters as $litter)
                                        <tr>
                                            <td class="fw-bold text-dark ps-4">{{ $litter->title }}</td>
                                            <td class="text-secondary fw-semibold">{{ $litter->birth_date }}</td>
                                            <td>
                                                @if($litter->status === 'Nata')
                                                    <span class="badge bg-success rounded-pill px-2">Nata</span>
                                                @elseif($litter->status === 'Svezzata')
                                                    <span class="badge bg-info rounded-pill px-2">Svezzata</span>
                                                @else
                                                    <span class="badge bg-warning text-dark rounded-pill px-2">In Programma</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="{{ route('admin.litters.show', $litter->id) }}" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fa-solid fa-eye me-1"></i> Vedi
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-baby-carriage fa-2x mb-2 opacity-25"></i>
                            <p class="m-0 small italic">Nessuna cucciolata registrata legata a questo riproduttore.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="deleteAdultModal{{ $adult->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Elimina Cane Adulto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                Sei sicuro di voler eliminare permanentemente <strong>{{ $adult->name }}</strong> dall'anagrafica?<br>
                <span class="text-danger fw-semibold"><i class="fa-solid fa-triangle-exclamation me-1"></i> Attenzione: Questa azione è irreversibile!</span>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Chiudi</button>
                <form action="{{ route('admin.adults.destroy', $adult) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection