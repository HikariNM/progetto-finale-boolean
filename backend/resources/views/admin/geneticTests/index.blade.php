@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark m-0">Registro Test Genetici</h1>
            <p class="text-muted m-0">Gestisci i test hemtici disponibili per i cani adulti</p>
        </div>
        <a href="{{ route('admin.genetic-test.create') }}" class="btn btn-primary shadow-sm">
            Nuovo Test
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
                            <th class="ps-4">Test Genetico</th>
                            <th>Descrizione</th>
                            <th class="text-center pe-4">Azioni</th>
                    </thead>
                    <tbody>
                        @forelse($geneticTests as $geneticTest)
                            <tr>
                                <td class="fw-bold text-dark ps-4 fs-5">
                                    {{ $geneticTest->name }}
                                </td>
                                
                                <td class="text-secondary fw-semibold">
                                    {{ $geneticTest->description}}
                                </td>
                                
                                <td class="text-center pe-4">
                                    <div class="btn-group" role="group">
                                        {{-- <a href="{{ route('admin.genetic-test.show', $geneticTest->id) }}" class="btn btn-sm btn-outline-secondary" title="Vedi Dettagli">
                                            <i class="fa-solid fa-eye"></i>
                                        </a> --}}
                                        <a href="{{ route('admin.genetic-test.edit', $geneticTest) }}" class="btn btn-sm btn-outline-secondary" title="Modifica">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Elimina" data-bs-toggle="modal" data-bs-target="#deleteLitterModal{{ $geneticTest->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteLitterModal{{ $geneticTest->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title fw-bold">Elimina Test Genetico</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Sei sicuro di voler eliminare permanentemente il test <strong>{{ $geneticTest->name }}</strong> dal catalogo?<br>
                                            <span class="text-danger fw-semibold"><i class="fa-solid fa-triangle-ex some me-1"></i> Attenzione: Questo eliminerà automaticamente anche i riultati registarti sui vari cani adulti!</span>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Chiudi</button>
                                            <form action="{{ route('admin.genetic-test.destroy', $geneticTest) }}" method="POST">
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
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-folder-open fa-3x mb-3 text-secondary opacity-50"></i>
                                    <p class="m-0 fs-5">Nessuna test in archivio.</p>
                                    <a href="{{ route('admin.litters.create') }}" class="btn btn-sm btn-primary mt-3">Crea il prima ora</a>
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