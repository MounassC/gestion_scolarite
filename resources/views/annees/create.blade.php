@extends('layouts.app')

@section('content')
<div class="card shadow col-md-6 mx-auto">
    <div class="card-header bg-primary text-white">Ajouter une Année</div>
    <div class="card-body">
        <form action="{{ route('annees.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Année Académique</label>
                <input type="text" name="anneeAc" class="form-control @error('anneeAc') is-invalid @enderror" placeholder="Ex: 2025-2026">
                @error('anneeAc') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('annees.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</div>
@endsection