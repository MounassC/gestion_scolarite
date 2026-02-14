@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-dark">
        Modifier le Niveau : {{ $niveau->nom_niveaux }}
    </div>
    <div class="card-body">
        <form action="{{ route('niveaux.update', $niveau->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom du Niveau</label>
                <input type="text" name="nom_niveaux" class="form-control" value="{{ old('nom_niveaux', $niveau->nom_niveaux) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <select name="categorie_niveau_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('categorie_niveau_id', $niveau->categorie_niveau_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->categorie_niveau }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</div>
@endsection