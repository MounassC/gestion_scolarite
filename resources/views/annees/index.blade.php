@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Années Académiques</h2>
    <a href="{{ route('annees.create') }}" class="btn btn-primary">Nouvelle Année</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Année Académique</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($annees as $annee)
                <tr>
                    <td>{{ $annee->id }}</td>
                    <td>{{ $annee->anneeAc }}</td>
                    <td>
                        <form action="{{ route('annees.destroy', $annee) }}" method="POST">
                            <a class="btn btn-sm btn-warning" href="{{ route('annees.edit', $annee) }}">Modifier</a>
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection