@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Années Académiques</h2>
    <a href="{{ route('annees.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nouvelle Année
    </a>
</div>

<div class="card shadow border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Dates École</th>
                    <th>Inscriptions</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($annees as $annee)
                <tr>
                    <td><strong>{{ $annee->code }}</strong></td>
                    <td>
                        <small>Du {{ \Carbon\Carbon::parse($annee->dateOuverture)->format('d/m/Y') }}<br>
                        au {{ \Carbon\Carbon::parse($annee->dateFermeture)->format('d/m/Y') }}</small>
                    </td>
                    <td>
                        <small>Du {{ \Carbon\Carbon::parse($annee->dateDebutInscription)->format('d/m/Y') }}<br>
                        au {{ \Carbon\Carbon::parse($annee->dateFinInscription)->format('d/m/Y') }}</small>
                    </td>
                    <td>
                        @php
                            $badgeClass = [
                                'brouillon' => 'bg-secondary',
                                'publie' => 'bg-info',
                                'ouvertureInscription' => 'bg-success',
                                'fermetureInscription' => 'bg-warning text-dark',
                                'cloture' => 'bg-danger'
                            ][$annee->statut];
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($annee->statut) }}</span>
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-1">
                            
                            <form action="{{ route('annees.publier', $annee) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $annee->statut == 'brouillon' ? 'btn-info' : 'btn-outline-secondary' }}" title="Rendre public">
                                    Publier
                                </button>
                            </form>

                            <form action="{{ route('annees.ouvrir-inscriptions', $annee) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $annee->statut == 'publie' ? 'btn-success' : 'btn-outline-secondary' }}">
                                    Ouvrir
                                </button>
                            </form>

                            <form action="{{ route('annees.fermer-inscriptions', $annee) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $annee->statut == 'ouvertureInscription' ? 'btn-dark' : 'btn-outline-secondary' }}">
                                    Fermer
                                </button>
                            </form>

                            <a class="btn btn-sm btn-warning" href="{{ route('annees.edit', $annee) }}"><i class="fas fa-edit"></i></a>
                            
                            <form action="{{ route('annees.destroy', $annee) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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