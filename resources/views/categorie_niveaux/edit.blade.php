@extends('layouts.app')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-warning text-dark fw-bold">
        <i class="fas fa-edit me-2"></i>Modifier la Catégorie
    </div>
    <div class="card-body">
        {{-- Utilisation du nom correct : $categorie_niveau --}}
        <form action="{{ route('categories.update', $categorie_niveau->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Nom de la Catégorie</label>
                <input type="text" 
                       name="categorie_niveau" 
                       class="form-control" 
                       value="{{ old('categorie_niveau', $categorie_niveau->categorie_niveau) }}">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection