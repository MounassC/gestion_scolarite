@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Créer un nouveau Tarif</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('tarifs.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Montant Inscription (FCFA)</label>
                            <input type="number" 
                                   name="inscription" 
                                   class="form-control @error('inscription') is-invalid @enderror" 
                                   placeholder="Ex: 50000" 
                                   value="{{ old('inscription') }}"
                                   required>
                            {{-- Optionnel : Message d'erreur spécifique sous le champ --}}
                            @error('inscription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mensualité (FCFA)</label>
                            <input type="number" 
                                   name="mensualite" 
                                   class="form-control @error('mensualite') is-invalid @enderror" 
                                   placeholder="Ex: 25000" 
                                   value="{{ old('mensualite') }}"
                                   required>
                            @error('mensualite')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary shadow-sm">
                                <i class="fas fa-save me-1"></i> Enregistrer ce tarif
                            </button>
                            <a href="{{ route('tarifs.index') }}" class="btn btn-light border">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection