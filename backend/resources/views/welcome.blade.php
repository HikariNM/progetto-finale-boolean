@extends('layouts.app')

@section('content')
    <div class="p-5 mb-5 bg-dark text-white rounded-4 shadow-sm relative overflow-hidden" 
         style="background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), url('https://images.unsplash.com/photo-1543466835-00a7907e9de1?q=80&w=1974&auto=format&fit=crop') center/cover no-repeat;">
        <div class="container-fluid py-4">
            <span class="badge bg-success px-3 py-2 rounded-pill text-uppercase fw-bold mb-3 tracking-wider">
                Vetrina Allevamento Professional
            </span>
            <h1 class="display-4 fw-bold mb-3">Passione per il Breeding,<br>Eccellenza Digitale</h1>
            <p class="col-md-8 lead text-white-50 mb-4">
                Benvenuto in Breeding Pro, la piattaforma integrata per tracciare le linee di sangue, monitorare la salute dei cuccioli e gestire il tuo allevamento cinofilo con un solo click.
            </p>
            
            <div class="d-flex gap-3 flex-wrap">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-lg px-4 shadow-sm">
                        <i class="fa-solid fa-gauge me-2"></i>Vai alla Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg px-4 shadow-sm">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>Accedi al Pannello
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                            Registrati come Operatore
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body text-center">
                    <div class="text-success fs-1 mb-3">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h5 class="card-title fw-bold">Albero Genealogico</h5>
                    <p class="card-text text-muted small">Registra le linee di sangue materne e paterne mantenendo lo storico genealogico cristallino per ogni cucciolata.</p>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body text-center">
                    <div class="text-success fs-1 mb-3">
                        <i class="fa-solid fa-dog"></i>
                    </div>
                    <h5 class="card-title fw-bold">Anagrafica Cuccioli</h5>
                    <p class="card-text text-muted small">Gestisci microchip, sesso, colori del mantello e aggiorna in tempo reale lo stato di adozione e disponibilità.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body text-center">
                    <div class="text-success fs-1 mb-3">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <h5 class="card-title fw-bold">Statistiche Integrate</h5>
                    <p class="card-text text-muted small">Tieni sempre sotto controllo i cuccioli disponibili, quelli già prenotati e l'andamento delle nascite dell'anno.</p>
                </div>
            </div>
        </div>
    </div>
@endsection