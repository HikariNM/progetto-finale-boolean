@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.puppies.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
                Torna al registro
            </a>
            <h1 class="fw-bold text-dark m-0">
                {{ $puppy->name }}
                @if($puppy->gender === 'Maschio')
                    <span class="text-info fs-3 ms-1"><i class="fa-solid fa-mars"></i></span>
                @else
                    <span class="text-danger fs-3 ms-1"><i class="fa-solid fa-venus"></i></span>
                @endif
            </h1>
            <p class="text-muted m-0">Scheda informativa dettagliata del cucciolo</p>
        </div>
        
        <div class="btn-group shadow-sm" role="group">
            <a href="{{ route('admin.puppies.edit', $puppy) }}" class="btn btn-white border fw-semibold">
                <i class="fa-solid fa-pen text-secondary me-1"></i> Modifica
            </a>
            <button type="button" class="btn btn-white border text-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#deletePuppyModal{{ $puppy->id }}">
                <i class="fa-solid fa-trash-can me-1"></i> Elimina
            </button>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            
            <div class="card shadow-sm border-0 text-center p-4 mb-4">
                <div class="mb-3">
                    @if($puppy->image)
                        <img src="{{ asset('storage/' . $puppy->image) }}" alt="Foto {{ $puppy->name }}" class="img-fluid rounded shadow-sm border" style="max-height: 250px; width: 100%; object-fit: cover;">
                    @else
                        <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center border" style="height: 200px;">
                            <i class="fa-solid fa-dog fa-3x text-secondary opacity-25 mb-2"></i>
                            <span class="text-muted small italic">Nessuna foto caricata</span>
                        </div>
                    @endif
                </div>
                
                <div class="d-flex justify-content-center gap-2">
                    @if($puppy->status === 'Disponibile')
                        <span class="badge bg-success rounded-pill px-3 py-2 fw-semibold">Disponibile</span>
                    @elseif($puppy->status === 'Prenotato')
                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-semibold">Prenotato</span>
                    @else
                        <span class="badge bg-secondary rounded-pill px-3 py-2 fw-semibold">Venduto</span>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="fw-bold m-0 text-dark"><i class="fa-solid fa-id-card text-primary me-2"></i>Dati Cucciolo</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="text-muted fw-semibold">Colore / Mantello:</span>
                            <span class="text-dark fw-bold">{{ $puppy->color ?? 'Non specificato' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="text-muted fw-semibold">Data di Nascita:</span>
                            <span class="text-dark fw-bold">{{ $puppy->litter->birth_date ?? 'Non specificata' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="text-muted fw-semibold">Cucciolata d'origine:</span>
                            <span class="text-dark fw-bold">{{ $puppy->litter->title ?? 'Nessuna' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-lg-8">
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="fw-bold m-0 text-dark">
                        <i class="fa-solid fa-dna text-warning me-2"></i>Genitori e Pedigree
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded border d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="bg-danger-subtle text-danger rounded p-2 me-3 fs-5">
                                        <i class="fa-solid fa-venus"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">Madre</div>
                                        <div class="fw-bold text-dark">{{ $puppy->litter->mother->name ?? 'Mamma non registrata' }}</div>
                                    </div>
                                </div>
                                @if(isset($puppy->litter->mother))
                                    <a href="{{ route('admin.adults.show', $puppy->litter->mother->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded border d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info-subtle text-info rounded p-2 me-3 fs-5">
                                        <i class="fa-solid fa-mars"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">Padre</div>
                                        <div class="fw-bold text-dark">{{ $puppy->litter->father->name ?? 'Papà non registrato' }}</div>
                                    </div>
                                </div>
                                @if(isset($puppy->litter->father))
                                    <a href="{{ route('admin.adults.show', $puppy->litter->father->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="fw-bold m-0 text-dark">
                        <i class="fa-solid fa-id-badge text-info me-2"></i>Fratelli e Sorelle
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if(isset($puppy->litter->puppies) && $puppy->litter->puppies->count() > 1)
                        <div class="list-group list-group-flush">
                            @foreach($puppy->litter->puppies as $sibling)
                                @if($sibling->id !== $puppy->id)
                                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                        <div>
                                            <span class="fw-bold text-dark">{{ $sibling->name }}</span>
                                            @if($sibling->gender === 'Maschio')
                                                <span class="text-info small ms-1"><i class="fa-solid fa-mars"></i></span>
                                            @else
                                                <span class="text-danger small ms-1"><i class="fa-solid fa-venus"></i></span>
                                            @endif
                                            <span class="text-muted small ms-2">({{ $sibling->color ?? 'colore n.d.' }})</span>
                                        </div>
                                        <a href="{{ route('admin.puppies.show', $sibling->id) }}" class="btn btn-sm btn-light border">
                                            Vedi Scheda
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fa-solid fa-paw fa-2x mb-2 opacity-25"></i>
                            <p class="m-0 small italic">Nessun fratello o sorella registrato per questa cucciolata</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="deletePuppyModal{{ $puppy->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Elimina Cucciolo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                Sei sicuro di voler eliminare permanentemente <strong>{{ $puppy->name }}</strong> dall'anagrafica?<br>
                <span class="text-danger fw-semibold"><i class="fa-solid fa-triangle-exclamation me-1"></i> Attenzione: Questa azione è irreversibile!</span>
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
@endsection