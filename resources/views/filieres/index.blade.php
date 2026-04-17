@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Liste des Filières</h2>
    <a href="{{ route('filieres.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Ajouter une Filière
    </a>
</div>

{{-- Affichage des messages de succès --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th class="text-center" width="200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($filieres as $filiere)
                    <tr>
                        {{-- Utilisation de $filiere->code comme dans ton code original --}}
                        <td><strong>{{ $filiere->code }}</strong></td>
                        <td>{{ $filiere->nomFiliere }}</td>
                        
                        <td class="text-center">
                            {{-- On utilise d-flex pour aligner les boutons horizontalement et gap-2 pour l'espace --}}
                            <div class="d-flex justify-content-center gap-2">
                                <a class="btn btn-sm btn-warning fw-bold px-3" href="{{ route('filieres.edit', $filiere) }}">
                                    Modifier
                                </a>

                                <form action="{{ route('filieres.destroy', $filiere) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger fw-bold px-3" onclick="return confirm('Voulez-vous vraiment supprimer cette filière ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            Aucune filière enregistrée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection