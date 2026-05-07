@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Gestion des Classes</h2>
            <p class="text-muted small">Configurez vos classes, niveaux et tarifs associés.</p>
        </div>
        <div>
            {{-- Bouton pour rattacher un tarif --}}
            <a href="{{ route('tarifs.rattacher.show') }}" class="btn btn-outline-success me-2">
                <i class="fas fa-link"></i> Rattacher un Tarif
            </a>
            <a href="{{ route('classes.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus"></i> Ajouter une Classe
            </a>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Code</th>
                            <th>Nom de la Classe</th>
                            <th>Filière / Niveau</th>
                            <th>Tarif Actuel</th>
                            <th class="text-center" width="150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $classe)
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-primary">{{ $classe->code_classe }}</span>
                                </td>
                                <td>{{ $classe->nom_classe }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge bg-info text-dark mb-1" style="width: fit-content;">
                                            {{ $classe->filiere->nomFiliere ?? 'N/A' }}
                                        </span>
                                        <small class="text-muted">{{ $classe->niveau->nom_niveaux ?? 'N/A' }}</small>
                                    </div>
                                </td>
                                <td>
                                    @php $tarif = $classe->tarifActif->first(); @endphp
                                    @if($tarif)
                                        <div class="small">
                                            <span class="text-success fw-bold">
                                                {{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA
                                            </span>
                                            <br>
                                            <span class="text-muted italic">Mensuel : {{ number_format($tarif->mensualite, 0, ',', ' ') }}</span>
                                        </div>
                                    @else
                                        <span class="text-danger small italic">
                                            <i class="fas fa-exclamation-circle"></i> Aucun tarif actif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <div class="btn-group">
                                        {{-- Bouton Modifier --}}
                                        <a href="{{ route('classes.edit', $classe) }}" class="btn btn-sm btn-outline-warning me-1" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Bouton Supprimer --}}
                                        <form action="{{ route('classes.destroy', $classe) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Attention : Cette action est irréversible. Supprimer ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 d-block text-secondary"></i>
                                    Aucune classe n'a été trouvée dans le système.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection