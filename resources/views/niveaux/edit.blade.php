@extends('layouts.app')

@section('content')

{{-- Affichage du message d'erreur lancé par le Service (try/catch) --}}


<div class="card shadow">
    <div class="card-header bg-warning text-dark">
        <i class="fas fa-layer-group"></i> Modifier le Niveau : {{ $niveau->nom_niveaux }}
    </div>
    <div class="card-body">
        <form action="{{ route('niveaux.update', $niveau->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Nom du Niveau</label>
                <input type="text" name="nom_niveaux" class="form-control @error('nom_niveaux') is-invalid @enderror" 
                    value="{{ old('nom_niveaux', $niveau->nom_niveaux) }}" required>
                @error('nom_niveaux')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Catégorie</label>
                <select name="categorie_niveau_id" class="form-select @error('categorie_niveau_id') is-invalid @enderror" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('categorie_niveau_id', $niveau->categorie_niveau_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->categorie_niveau }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_niveau_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection