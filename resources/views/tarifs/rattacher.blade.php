@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Rattacher un Tarif à une Classe</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tarifs.rattacher.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Sélectionner la Classe</label>
                    <select name="classe_id" class="form-select" required>
                        <option value="">-- Choisir une classe --</option>
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom_classe }} ({{ $classe->code_classe }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sélectionner le Tarif à appliquer</label>
                    <select name="tarif_id" class="form-select" required>
                        <option value="">-- Choisir un tarif --</option>
                        @foreach($tarifs as $tarif)
                            <option value="{{ $tarif->id }}">
                                Inscription: {{ $tarif->inscription }} | Mensualité: {{ $tarif->mensualite }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> 
                    Note : Le tarif précédent de la classe sera automatiquement désactivé.
                </div>

                <button type="submit" class="btn btn-success text-white">Valider le nouveau tarif</button>
                <a href="{{ route('tarifs.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection