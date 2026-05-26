@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="h2 text-dark font-weight-bold">Pannello di Controllo</h1>
        <p class="text-muted">Benvenuto nel gestionale del tuo allevamento. Ecco una panoramica dello stato attuale.</p>
    </div>

    <div class="row g-4 mb-4">
        
        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-muted text-uppercase small mb-1">Cucciolate Totali</h6>
                        <h3 class="display-6 fw-bold text-dark mb-2">{{ $totalLitters }}</h3>
                        <a href="{{ route('admin.litters.index') }}" class="text-success text-decoration-none small fw-bold">Gestisci</a>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded p-3 fs-3">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-muted text-uppercase small mb-1">Cani Adulti</h6>
                        <h3 class="display-6 fw-bold text-dark mb-2">{{ $totalAdult }}</h3>
                        <a href="{{ route('admin.litters.index') }}" class="text-success text-decoration-none small fw-bold">Gestisci</a>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded p-3 fs-3">
                        <i class="fa-solid fa-dog"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-muted text-uppercase small mb-1">Cuccioli Registrati</h6>
                        <h3 class="display-6 fw-bold text-dark mb-2">{{ $totalPuppies }}</h3>
                        <a href="{{ route('admin.puppies.index') }}" class="text-success text-decoration-none small fw-bold">Vedi tutti</a>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded p-3 fs-3">
                        <i class="fa-solid fa-dog"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-muted text-uppercase small mb-1">Cuccioli Disponibili </h6>
                        <h3 class="display-6 fw-bold text-success mb-2">{{ $availablePuppies }}</h3>
                        <a href="{{ route('admin.puppies.index') }}" class="text-success text-decoration-none small fw-bold">Filtra pronti</a>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded p-3 fs-3">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold text-dark mb-3">Azioni Rapide</h5>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.litters.create') }}" class="btn btn-dark px-4 py-2 shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> Nuova Cucciolata
                </a>
                <a href="{{ route('admin.puppies.create') }}" class="btn btn-dark px-4 py-2 shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> Aggiungi Singolo Cucciolo
                </a>
                <a href="{{ route('admin.adults.create') }}" class="btn btn-dark px-4 py-2 shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> Aggiungi Cane Adulto
                </a>
            </div>
        </div>
    </div>
@endsection