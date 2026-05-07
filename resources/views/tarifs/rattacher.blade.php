@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-link me-2"></i>Rattacher un Tarif à une Classe</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('tarifs.rattacher.store') }}" method="POST">
                        @csrf
                        
                        {{-- Sélection de la Classe --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Sélectionner la Classe</label>
                            <select name="classe_id" class="form-select @error('classe_id') is-invalid @enderror" required>
                                <option value="">-- Choisir une classe --</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} [{{ $classe->code_classe }}]
                                    </option>
                                @endforeach
                            </select>
                            @error('classe_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sélection du Tarif --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Sélectionner le Tarif à appliquer</label>
                            <select name="tarif_id" class="form-select @error('tarif_id') is-invalid @enderror" required>
                                <option value="">-- Choisir un tarif --</option>
                                @foreach($tarifs as $tarif)
                                    <option value="{{ $tarif->id }}" {{ old('tarif_id') == $tarif->id ? 'selected' : '' }}>
                                        Inscription : {{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA | 
                                        Mensualité : {{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA
                                    </option>
                                @endforeach
                            </select>
                            @error('tarif_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-warning border-0 shadow-sm mb-4">
                            <div class="d-flex">
                                <i class="fas fa-history me-3 mt-1 fs-5"></i>
                                <div>
                                    <span class="fw-bold">Gestion de l'historique :</span><br>
                                    Le tarif actuellement actif pour cette classe sera archivé. Le nouveau tarif s'appliquera pour les prochaines opérations.
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3">
                            <a href="{{ route('tarifs.index') }}" class="btn btn-light border">
                                <i class="fas fa-times me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success text-white px-4">
                                <i class="fas fa-check-circle me-1"></i> Valider le nouveau tarif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection