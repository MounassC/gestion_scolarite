@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6"> {{-- Réduit à 6 car moins de champs --}}
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark py-3">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier le Tarif du Catalogue</h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('tarifs.update', $tarif->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Montant Inscription (FCFA)</label>
                            <input type="number" 
                                   name="inscription" 
                                   class="form-control @error('inscription') is-invalid @enderror" 
                                   value="{{ (int)old('inscription', $tarif->inscription) }}" 
                                   required>
                            @error('inscription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Mensualité (FCFA)</label>
                            <input type="number" 
                                   name="mensualite" 
                                   class="form-control @error('mensualite') is-invalid @enderror" 
                                   value="{{ (int)old('mensualite', $tarif->mensualite) }}" 
                                   required>
                            @error('mensualite')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info border-0 shadow-sm">
                            <small><i class="fas fa-info-circle me-1"></i> La modification impactera les classes qui utiliseront ce tarif à l'avenir.</small>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sync-alt me-1"></i> Mettre à jour le tarif
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