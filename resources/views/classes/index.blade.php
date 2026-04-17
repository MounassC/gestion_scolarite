@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Liste des Classes</h2>
    <div>
        {{-- Bouton pour rattacher un tarif (Nouvelle action) --}}
        <a href="{{ route('tarifs.rattacher.show') }}" class="btn btn-outline-success me-2">
            <i class="fas fa-link"></i> Rattacher un Tarif
        </a>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une Classe
        </a>
    </div>
</div>

{{-- Affichage des messages de succès --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Nom de la Classe</th>
                    <th>Filière</th>
                    <th>Niveau</th>
                    {{-- Nouvelle colonne pour le tarif --}}
                    <th>Tarif Actuel (Insc. / Mens.)</th>
                    <th class="text-center" width="200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $classe)
                    <tr>
                        <td><strong>{{ $classe->code_classe }}</strong></td>
                        <td>{{ $classe->nom_classe }}</td>
                        <td><span class="badge bg-info text-dark">{{ $classe->filiere->nomFiliere ?? 'N/A' }}</span></td>
                        <td>{{ $classe->niveau->nom_niveaux ?? 'N/A' }}</td>
                        
                        {{-- Logique d'affichage du tarif actif --}}
                        <td>
                            @php $tarif = $classe->tarifActif->first(); @endphp
                            @if($tarif)
                                <span class="text-success fw-bold">
                                    {{ number_format($tarif->inscription, 0, ',', ' ') }} / 
                                    {{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA
                                </span>
                            @else
                                <span class="text-muted small italic">Aucun tarif actif</span>
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('classes.destroy', $classe) }}" method="POST">
                                <a class="btn btn-sm btn-warning" href="{{ route('classes.edit', $classe) }}">
                                    Modifier
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette classe ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucune classe enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection