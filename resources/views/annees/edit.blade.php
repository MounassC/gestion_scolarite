@extends('layouts.app')

@section('content')
<div class="card shadow col-md-6 mx-auto">
    <div class="card-header bg-warning">Modifier l'Année</div>
    <div class="card-body">
        <form action="{{ route('annees.update', $annee) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Année Académique</label>
                <input type="text" name="anneeAc" class="form-control" value="{{ $annee->anneeAc }}">
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('annees.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection