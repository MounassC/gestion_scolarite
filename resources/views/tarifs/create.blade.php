@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Créer un nouveau Tarif dans le catalogue</h5>
                </div>
                <div class="card-body">
                    
                    {{-- AJOUT : Affichage des erreurs de validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tarifs.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Montant Inscription (FCFA)</label>
                            {{-- AJOUT : value="{{ old('inscription') }}" et la classe is-invalid --}}
                            <input type="number" 
                                   name="inscription" 
                                   class="form-control @error('inscription') is-invalid @enderror" 
                                   placeholder="Ex: 50000" 
                                   value="{{ old('inscription') }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mensualité (FCFA)</label>
                            {{-- AJOUT : value="{{ old('mensualite') }}" et la classe is-invalid --}}
                            <input type="number" 
                                   name="mensualite" 
                                   class="form-control @error('mensualite') is-invalid @enderror" 
                                   placeholder="Ex: 25000" 
                                   value="{{ old('mensualite') }}"
                                   required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Enregistrer ce tarif</button>
                            <a href="{{ route('tarifs.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection