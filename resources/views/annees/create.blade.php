@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Paramétrer une Nouvelle Année Académique</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('annees.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Code de l'année</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" 
                               placeholder="Ex: 2025-2026" value="{{ old('code') }}">
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-light border-0 mb-3">
                                <div class="card-body">
                                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-school me-2"></i>Période Scolaire</h6>
                                    <div class="mb-3">
                                        <label class="small fw-bold">Date Ouverture</label>
                                        <input type="date" name="dateOuverture" class="form-control @error('dateOuverture') is-invalid @enderror" value="{{ old('dateOuverture') }}">
                                        @error('dateOuverture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-0">
                                        <label class="small fw-bold">Date Fermeture</label>
                                        <input type="date" name="dateFermeture" class="form-control @error('dateFermeture') is-invalid @enderror" value="{{ old('dateFermeture') }}">
                                        @error('dateFermeture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card bg-light border-0 mb-3">
                                <div class="card-body">
                                    <h6 class="fw-bold text-success mb-3"><i class="fas fa-user-edit me-2"></i>Période d'Inscription</h6>
                                    <div class="mb-3">
                                        <label class="small fw-bold">Début Inscriptions</label>
                                        <input type="date" name="dateDebutInscription" class="form-control @error('dateDebutInscription') is-invalid @enderror" value="{{ old('dateDebutInscription') }}">
                                        @error('dateDebutInscription') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-0">
                                        <label class="small fw-bold">Fin Inscriptions</label>
                                        <input type="date" name="dateFinInscription" class="form-control @error('dateFinInscription') is-invalid @enderror" value="{{ old('dateFinInscription') }}">
                                        @error('dateFinInscription') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info small mt-3">
                        <i class="fas fa-info-circle me-1"></i> 
                        L'année sera créée avec le statut <strong>Brouillon</strong> par défaut.
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('annees.index') }}" class="btn btn-secondary px-4">Annuler</a>
                        <button type="submit" class="btn btn-primary px-4">Créer l'année</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection