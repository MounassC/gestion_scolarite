@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Liste des Niveaux</h2>
    <a href="{{ route('niveaux.create') }}" class="btn btn-primary">Ajouter un Niveau</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Niveau</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($niveaux as $niveau)
                <tr>
                    <td>{{ $niveau->id }}</td>
                    <td><strong>{{ $niveau->nom_niveaux }}</strong></td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $niveau->categorie_niveau->categorie_niveau ?? 'Non définie' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('niveaux.destroy', $niveau) }}" method="POST">
                            <a class="btn btn-sm btn-warning" href="{{ route('niveaux.edit', $niveau) }}">Modifier</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce niveau ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection