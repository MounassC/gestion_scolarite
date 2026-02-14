@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Modifier le Tarif : {{ $tarif->classe->nom_classe }}</h5>
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

                    <form action="{{ route('tarifs.update', $tarif->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Choix de la Classe --}}
                        <div class="mb-3">
                            <label for="classe_id" class="form-label">Classe concernée</label>
                            <select name="classe_id" id="classe_id" class="form-select @error('classe_id') is-invalid @enderror" required>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}" 
                                        {{ (old('classe_id', $tarif->classe_id) == $classe->id) ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} ({{ $classe->filiere->nomFiliere ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            {{-- Frais d'Inscription --}}
                            <div class="col-md-6 mb-3">
                                <label for="inscription" class="form-label">Frais d'Inscription</label>
                                <div class="input-group">
                                    <input type="number" name="inscription" id="inscription" 
                                           class="form-control" 
                                           value="{{ old('inscription', $tarif->inscription) }}" required>
                                    <span class="input-group-text">CFA</span>
                                </div>
                            </div>

                            {{-- Mensualité --}}
                            <div class="col-md-6 mb-3">
                                <label for="mensualite" class="form-label">Mensualité</label>
                                <div class="input-group">
                                    <input type="number" name="mensualite" id="mensualite" 
                                           class="form-control" 
                                           value="{{ old('mensualite', $tarif->mensualite) }}" required>
                                    <span class="input-group-text">CFA</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary">
                                Mettre à jour le Tarif
                            </button>
                            <a href="{{ route('tarifs.index') }}" class="btn btn-secondary">
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