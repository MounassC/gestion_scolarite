@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Ajouter une Nouvelle Classe</h5>
                </div>
                
                <div class="card-body">
                    {{-- Affichage des erreurs de validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('classes.store') }}" method="POST">
                        @csrf

                        {{-- Champ Code de la Classe --}}
                        <div class="mb-3">
                            <label for="code_classe" class="form-label">Code de la Classe</label>
                            <input type="text" name="code_classe" id="code_classe" 
                                   class="form-control @error('code_classe') is-invalid @enderror" 
                                   value="{{ old('code_classe') }}" 
                                   placeholder="Ex: L1-INFO" required>
                        </div>

                        {{-- Champ Nom de la Classe --}}
                        <div class="mb-3">
                            <label for="nom_classe" class="form-label">Nom de la Classe</label>
                            <input type="text" name="nom_classe" id="nom_classe" 
                                   class="form-control @error('nom_classe') is-invalid @enderror" 
                                   value="{{ old('nom_classe') }}" 
                                   placeholder="Ex: Licence 1 Informatique" required>
                        </div>

                        {{-- Sélection de la Filière --}}
                        <div class="mb-3">
                            <label for="filiere_id" class="form-label">Filière</label>
                            <select name="filiere_id" id="filiere_id" class="form-select @error('filiere_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Choisir une filière...</option>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nomFiliere }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sélection du Niveau --}}
                        <div class="mb-3">
                            <label for="niveau_id" class="form-label">Niveau</label>
                            <select name="niveau_id" id="niveau_id" class="form-select @error('niveau_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Choisir un niveau...</option>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}" {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>
                                        {{ $niveau->nom_niveaux }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Enregistrer la Classe
                            </button>
                            <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection