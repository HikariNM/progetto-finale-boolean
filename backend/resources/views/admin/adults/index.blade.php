@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark m-0">Registro Cani Adulti</h1>
            <p class="text-muted m-0">Gestisci l'anagrafica dei riproduttori e la loro bacheca trofei.</p>
        </div>
        <a href="{{ route('admin.adults.create') }}" class="btn btn-primary shadow-sm">
            Aggiungi Cane 
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-dashbrd-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-7 border-bottom">
                        <tr>
                            <th class="ps-4">Nome</th>
                            <th>Genere</th>
                            <th>Razza</th>
                            <th>Microchip / Pedigree</th>
                            <th>Stato Riproduttivo</th>
                            <th class="text-center">Bacheca Titoli</th>
                            <th class="text-center pe-4">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($adults as $adult)
                            <tr>
                                <td class="fw-bold text-dark ps-4 fs-5">
                                    {{ $adult->name }}
                                </td>
                                
                                <td>
                                    @if($adult->gender === 'Maschio')
                                        <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3">
                                            <i class="fa-solid fa-mars me-1"></i> Maschio
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">
                                            <i class="fa-solid fa-venus me-1"></i> Femmina
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="text-secondary">
                                    {{ $adult->breed }}
                                </td>
                                
                                <td>
                                    <div class="small fw-semibold text-dark">{{ $adult->microchip }}</div>
                                    <div class="small text-muted">{{ $adult->pedigree_code ?? 'Nessun Pedigree' }}</div>
                                </td>
                                
                                <td>
                                    @if($adult->status === 'Attivo')
                                        <span class="badge bg-success rounded-pill px-2 me-1">Attivo</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-2 me-1">Ritirato</span>
                                    @endif

                                    @if($adult->is_neutered)
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2" title="Castrato/Sterilizzato">
                                            <i class="fa-solid fa-scissors small"></i> Sterilizzato
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    @if($adult->titles->count() > 0)
                                        <span class="badge bg-warning text-dark rounded-pill px-3 fw-bold shadow-sm" data-bs-toggle="tooltip" title="@foreach($adult->titles as $t){{ $t->name }}&#10;@endforeach">
                                            {{ $adult->titles->count() }} {{ $adult->titles->count() === 1 ? 'Titolo' : 'Titoli' }}
                                        </span>
                                    @else
                                        <span class="text-muted small italic">Nessun titolo</span>
                                    @endif
                                </td>
                                
                                <td class="text-center pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.adults.show', $adult->id) }}" class="btn btn-sm btn-outline-secondary" title="Vedi Dettagli">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{route('admin.adults.edit', $adult)}}" class="btn btn-sm btn-outline-secondary" title="Modifica">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Elimina" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-dog fa-3x mb-3 text-secondary opacity-50"></i>
                                    <p class="m-0 fs-5">Nessun cane adulto registrato in anagrafica.</p>
                                    <a href="{{ route('admin.adults.create') }}" class="btn btn-sm btn-primary mt-3">Registra il primo ora</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this dog info?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('admin.adults.destroy', $adult) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection