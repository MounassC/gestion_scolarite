@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Tarifs</h2>
    <a href="{{ route('tarifs.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Configurer un Tarif
    </a>
</div>

<div class="card shadow">
    <div class="card-body p-0"> {{-- p-0 pour que le tableau colle aux bords de la carte --}}
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Classe</th>
                    <th>Filière</th>
                    <th class="text-end">Frais d'Inscription</th>
                    <th class="text-end">Mensualité</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tarifs as $tarif)
                    <tr>
                        <td>
                            <span class="fw-bold text-primary">{{ $tarif->classe->nom_classe ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <small class="text-muted">{{ $tarif->classe->filiere->nomFiliere ?? '-' }}</small>
                        </td>
                        <td class="text-end">
                            {{ number_format($tarif->inscription, 0, ',', ' ') }} <small>CFA</small>
                        </td>
                        <td class="text-end">
                            {{ number_format($tarif->mensualite, 0, ',', ' ') }} <small>CFA</small>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('tarifs.destroy', $tarif) }}" method="POST">
                                <a href="{{ route('tarifs.edit', $tarif) }}" class="btn btn-sm btn-outline-warning">
                                    Modifier
                                </a>
                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Supprimer ce tarif ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Aucun tarif n'a encore été configuré.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Petit récapitulatif en bas de page --}}
<div class="mt-3 text-muted small">
    <p>* Les montants sont exprimés en Francs CFA.</p>
</div>
@endsection