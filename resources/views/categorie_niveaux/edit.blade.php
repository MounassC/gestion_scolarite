@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-dark">Modifier la Catégorie</div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom de la Catégorie</label>
                <input type="text" name="categorie_niveau" class="form-control" value="{{ old('categorie_niveau', $category->categorie_niveau) }}">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</div>
@endsection