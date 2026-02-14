@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">Ajouter un Niveau</div>
    <div class="card-body">

        {{-- 1. Affichage des erreurs de validation (ex: champ vide) --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 2. Affichage du message de succès (Flash message du controller) --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('niveaux.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nom du Niveau</label>
                <input type="text" name="nom_niveaux" 
                       class="form-control @error('nom_niveaux') is-invalid @enderror" 
                       value="{{ old('nom_niveaux') }}" 
                       placeholder="Ex: Licence 1">
                @error('nom_niveaux')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <select name="categorie_niveau_id" class="form-select @error('categorie_niveau_id') is-invalid @enderror">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('categorie_niveau_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->categorie_niveau }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_niveau_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </form>
    </div>
</div>
@endsection