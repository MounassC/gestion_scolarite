@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Liste des Classes</h2>
    <a href="{{ route('classes.create') }}" class="btn btn-primary">Ajouter une Classe</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Nom de la Classe</th>
                    <th>Filière</th>
                    <th>Niveau</th>
                    <th width="200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $classe)
                    <tr>
                        <td><strong>{{ $classe->code_classe }}</strong></td>
                        <td>{{ $classe->nom_classe }}</td>
                        <td><span class="badge bg-info text-dark">{{ $classe->filiere->nomFiliere ?? 'N/A' }}</span></td>
                        <td>{{ $classe->niveau->nom_niveaux ?? 'N/A' }}</td>
                        <td>
                            <form action="{{ route('classes.destroy', $classe) }}" method="POST">
                                <a class="btn btn-sm btn-warning" href="{{ route('classes.edit', $classe) }}">Modifier</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette classe ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune classe enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection