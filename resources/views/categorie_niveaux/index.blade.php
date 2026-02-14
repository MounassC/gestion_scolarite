@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Catégories de Niveaux</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Ajouter une Catégorie</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td><strong>{{ $cat->categorie_niveau }}</strong></td>
                    <td>
                        <form action="{{ route('categories.destroy', $cat) }}" method="POST">
                            <a class="btn btn-sm btn-warning" href="{{ route('categories.edit', $cat) }}">Modifier</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection