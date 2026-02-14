@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Configurer un Nouveau Tarif</h5>
                </div>
                
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tarifs.store') }}" method="POST">
                        @csrf

                        {{-- Choix de la Classe --}}
                        <div class="mb-3">
                            <label for="classe_id" class="form-label">Classe concernée</label>
                            <select name="classe_id" id="classe_id" class="form-select @error('classe_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Choisir une classe...</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} ({{ $classe->filiere->nomFiliere ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Le tarif sera appliqué spécifiquement à cette classe.</div>
                        </div>

                        <div class="row">
                            {{-- Montant Inscription --}}
                            <div class="col-md-6 mb-3">
                                <label for="inscription" class="form-label">Frais d'Inscription</label>
                                <div class="input-group">
                                    <input type="number" name="inscription" id="inscription" 
                                           class="form-control @error('inscription') is-invalid @enderror" 
                                           value="{{ old('inscription') }}" 
                                           placeholder="Ex: 50000" required>
                                    <span class="input-group-text">CFA</span>
                                </div>
                            </div>

                            {{-- Montant Mensualité --}}
                            <div class="col-md-6 mb-3">
                                <label for="mensualite" class="form-label">Mensualité</label>
                                <div class="input-group">
                                    <input type="number" name="mensualite" id="mensualite" 
                                           class="form-control @error('mensualite') is-invalid @enderror" 
                                           value="{{ old('mensualite') }}" 
                                           placeholder="Ex: 25000" required>
                                    <span class="input-group-text">CFA</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-success">
                                Enregistrer le Tarif
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