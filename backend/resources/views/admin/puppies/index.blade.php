@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark m-0">Registro Cuccioli</h1>
            <p class="text-muted m-0">Gestisci l'anagrafica dei cuccioli, le loro informazioni e lo stato di adozione</p>
        </div>
        <a href="{{ route('admin.puppies.create') }}" class="btn btn-primary shadow-sm">
            Aggiungi Cucciolo 
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                            <th>Cucciolata</th>
                            <th>Data di nascita</th>
                            <th>Colore</th>
                            <th>Coda</th>
                            <th>Stato</th>
                            <th class="text-center pe-4">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($puppies as $puppy)
                            <tr>
                                <td class="fw-bold text-dark ps-4 fs-5">
                                    {{ $puppy->name }}
                                </td>
                                
                                <td>
                                    @if($puppy->gender === 'Maschio')
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
                                    {{ $puppy->litter->title ?? 'Nessuna cucciolata' }}
                                </td>
                                <td class="text-secondary">
                                    {{ $puppy->litter->birth_date ?? 'Non ancora nata' }}
                                </td>
                                
                                <td class="text-secondary">
                                    {{ $puppy->coat_color ?? 'Non specificato' }}
                                </td>
                                <td class="text-secondary">
                                    {{ $puppy->tail_type ?? 'Non specificato' }}
                                </td>
                                
                                <td>
                                    @if($puppy->status === 'Disponibile')
                                        <span class="badge bg-success rounded-pill px-2 me-1">Disponibile</span>
                                    @elseif($puppy->status === 'Prenotato')
                                        <span class="badge bg-warning text-dark rounded-pill px-2 me-1">Prenotato</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-2 me-1">Venduto</span>
                                    @endif
                                </td>
                                
                                <td class="text-center pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.puppies.show', $puppy->id) }}" class="btn btn-sm btn-outline-secondary" title="Vedi Dettagli">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.puppies.edit', $puppy) }}" class="btn btn-sm btn-outline-secondary" title="Modifica">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Elimina" data-bs-toggle="modal" data-bs-target="#deletePuppyModal{{ $puppy->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deletePuppyModal{{ $puppy->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $puppy->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel{{ $puppy->id }}">Elimina Cucciolo</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Sei sicuro di voler eliminare permanentemente il cucciolo <strong>{{ $puppy->name }}</strong>?<br>
                                            <span class="text-danger fw-semibold"><i class="fa-solid fa-triangle-exclamation me-1"></i> Attenzione: Questa azione eliminerà anche l'immagine associata ed è irreversibile!</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                            <form action="{{ route('admin.puppies.destroy', $puppy) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Elimina">
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-dog fa-3x mb-3 text-secondary opacity-50"></i>
                                    <p class="m-0 fs-5">Nessun cucciolo registrato in anagrafica.</p>
                                    <a href="{{ route('admin.puppies.create') }}" class="btn btn-sm btn-primary mt-3">Registra il primo ora</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection