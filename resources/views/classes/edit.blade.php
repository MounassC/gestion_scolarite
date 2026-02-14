@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Modifier la Classe : {{ $class->nom_classe }}</h5>
                </div>
                
                <div class="card-body">
                    {{-- Affichage des erreurs --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('classes.update', $class->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Indispensable pour la modification dans Laravel --}}

                        {{-- Code de la Classe --}}
                        <div class="mb-3">
                            <label class="form-label">Code de la Classe</label>
                            <input type="text" name="code_classe" 
                                class="form-control" 
                                value="{{ old('code_classe', $class->code_classe) }}" required>
                        </div>

                        {{-- Nom de la Classe --}}
                       <div class="mb-3">
                            <label class="form-label">Nom de la Classe</label>
                            <input type="text" name="nom_classe" 
                                class="form-control" 
                                value="{{ old('nom_classe', $class->nom_classe) }}" required>
                        </div>

                        {{-- Sélection de la Filière --}}
                        <div class="mb-3">
                            <label class="form-label">Filière</label>
                            <select name="filiere_id" class="form-select" required>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" 
                                        {{ (old('filiere_id', $class->filiere_id) == $filiere->id) ? 'selected' : '' }}>
                                        {{ $filiere->nomFiliere }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sélection du Niveau --}}
                        <div class="mb-3">
                            <label class="form-label">Niveau</label>
                            <select name="niveau_id" class="form-select" required>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}" 
                                        {{ (old('niveau_id', $class->niveau_id) == $niveau->id) ? 'selected' : '' }}>
                                        {{ $niveau->nom_niveaux }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary">
                                Mettre à jour
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