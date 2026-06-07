@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Gestione Utenti</h2>
        @if (auth()->user()->is_admin)
            
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Nuovo Utente</a>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Creato il</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                <td>
                    @if ($user->id === auth()->id())
                    <span class="text-muted small">Tu</span>

                    
                    @elseif (auth()->user()->is_admin)
                    <button type="button" class="btn btn-sm btn-outline-danger" title="Elimina" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>

                    <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold">Elimina Utente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    Sei sicuro di voler eliminare permanentemente l'utente'<strong>{{ $user->name }}</strong>?<br>
                                    <span class="text-danger fw-semibold"><i class="fa-solid fa-triangle-ex some me-1"></i> Attenzione: Questa azione è irreversibile!</span>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Chiudi</button>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-pill px-4">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection