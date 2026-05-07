@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-dark">
        Modifier la Classe : {{ $class->nom_classe }}
    </div>
    <div class="card-body">
        {{-- L'action pointe vers classes.update avec l'id de la classe --}}
        <form action="{{ route('classes.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Code de la Classe</label>
                <input type="text" name="code_classe" class="form-control @error('code_classe') is-invalid @enderror" 
                    value="{{ old('code_classe', $class->code_classe) }}" required>
                @error('code_classe')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nom de la Classe</label>
                <input type="text" name="nom_classe" class="form-control @error('nom_classe') is-invalid @enderror" 
                    value="{{ old('nom_classe', $class->nom_classe) }}" required>
                @error('nom_classe')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Filière</label>
                <select name="filiere_id" class="form-select" required>
                    @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id }}" {{ (old('filiere_id', $class->filiere_id) == $filiere->id) ? 'selected' : '' }}>
                            {{ $filiere->nomFiliere }} {{-- Bien vu pour le nomFiliere ! --}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Niveau</label>
                <select name="niveau_id" class="form-select" required>
                    @foreach($niveaux as $niveau)
                        <option value="{{ $niveau->id }}" {{ (old('niveau_id', $class->niveau_id) == $niveau->id) ? 'selected' : '' }}>
                            {{ $niveau->nom_niveaux }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</div>
@endsection