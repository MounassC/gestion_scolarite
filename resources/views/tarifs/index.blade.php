@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark">Catalogue des Tarifs</h2>
        <p class="text-muted small">Les tarifs avec des classes liées sont protégés contre la modification.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('tarifs.rattacher.show') }}" class="btn btn-outline-primary">
            <i class="fas fa-link me-1"></i> Rattacher à une classe
        </a>
        <a href="{{ route('tarifs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nouveau Tarif
        </a>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3">Inscription</th>
                    <th class="py-3">Mensualité</th>
                    <th class="py-3 text-center">État / Utilisation</th>
                    <th class="py-3 text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tarifs as $tarif)
                    @php
                        // On considère le tarif "verrouillé" s'il est lié à au moins une classe
                        // Plus tard, on affinera avec "si la classe a des étudiants"
                        $isLocked = $tarif->classes()->exists();
                    @endphp
                <tr>
                    <td class="ps-4 fw-bold text-primary">
                        {{ number_format($tarif->inscription, 0, ',', ' ') }} <small>FCFA</small>
                    </td>
                    <td>
                        {{ number_format($tarif->mensualite, 0, ',', ' ') }} <small>FCFA</small>
                    </td>
                    <td class="text-center">
                        @if($isLocked)
                            <span class="badge bg-lock text-secondary border border-secondary" style="background-color: #f8f9fa;">
                                <i class="fas fa-lock me-1"></i> Utilisé (Verrouillé)
                            </span>
                        @else
                            <span class="badge bg-success-subtle text-success border border-success">
                                <i class="fas fa-check me-1"></i> Libre
                            </span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            {{-- Si verrouillé, on désactive le bouton modifier --}}
                            @if($isLocked)
                                <button class="btn btn-sm btn-outline-secondary" disabled title="Modification impossible : déjà utilisé">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @else
                                <a href="{{ route('tarifs.edit', $tarif) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            
                            {{-- Suppression : Toujours protégée par le Service --}}
                            <form action="{{ route('tarifs.destroy', $tarif) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce tarif ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" {{ $isLocked ? 'disabled' : '' }}>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                        Aucun tarif dans le catalogue.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection