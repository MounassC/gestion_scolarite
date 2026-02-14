@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Liste des Filières</h2>
    <a href="{{ route('filieres.create') }}" class="btn btn-primary">
        + Ajouter une Filière
    </a>
</div>

<table class="table table-bordered table-striped shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Nom</th>
            <th width="200">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($filieres as $filiere)
        <tr>
            <td>{{ $filiere->id }}</td>
            <td>{{ $filiere->code }}</td>
            <td>{{ $filiere->nomFiliere }}</td>
            <td>
                <a href="{{ route('filieres.edit', $filiere) }}" class="btn btn-warning btn-sm">
                    Modifier
                </a>

                <form action="{{ route('filieres.destroy', $filiere) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Voulez-vous vraiment supprimer ?')">
                        Supprimer
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">
                Aucune filière enregistrée
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
