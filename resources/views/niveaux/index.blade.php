@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Liste des Niveaux</h2>
    <a href="{{ route('niveaux.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Ajouter un Niveau
    </a>
</div>

<div class="card shadow">
    <div class="card-body"> {{-- p-0 pour un look plus moderne --}}
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Nom du Niveau</th>
                    <th class="text-center">Catégorie</th>
                    {{-- Titre centré --}}
                    <th class="text-center" width="200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($niveaux as $niveau)
                <tr>
                    <td class="ps-4"><strong>{{ $niveau->nom_niveaux }}</strong></td>
                    <td class="text-center">
                        <span class="badge bg-info text-dark px-3">
                            {{ $niveau->categorie_niveau->categorie_niveau ?? 'Non définie' }}
                        </span>
                    </td>
                    {{-- Cellule centrée avec Flexbox --}}
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-sm btn-warning fw-bold px-3" href="{{ route('niveaux.edit', $niveau) }}">
                                Modifier
                            </a>
                            
                            <form action="{{ route('niveaux.destroy', $niveau) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger fw-bold px-3" onclick="return confirm('Supprimer ce niveau ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection