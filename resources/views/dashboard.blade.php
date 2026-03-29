@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Tableau de Bord</h2>
        <span class="badge bg-white text-primary shadow-sm p-2">
            <i class="fas fa-calendar-day me-1"></i> Session {{ date('Y') }}-{{ date('Y')+1 }}
        </span>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 bg-white border-start border-primary border-4">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small fw-bold">Total Classes</h6>
                        <h3 class="mb-0 fw-bold">{{ $countClasses }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 bg-white border-start border-success border-4">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="fas fa-book fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small fw-bold">Filières</h6>
                        <h3 class="mb-0 fw-bold">{{ $countFilieres }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 bg-white border-start border-warning border-4">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="fas fa-money-check-alt fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small fw-bold">Tarifs Actifs</h6>
                        <h3 class="mb-0 fw-bold">{{ $countTarifs }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-list me-2 text-primary"></i>Dernières Classes</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Code</th>
                                    <th>Nom de la Classe</th>
                                    <th>Filière</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentClasses as $classe)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">{{ $classe->code_classe }}</td>
                                    <td>{{ $classe->nom_classe }}</td>
                                    <td><span class="badge bg-light text-dark">{{ $classe->filiere->nomFiliere ?? 'N/A' }}</span></td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('classes.index') }}" class="btn btn-sm btn-outline-primary">Voir</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Aucune classe enregistrée.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Actions Rapides</h5>
                    <div class="d-grid gap-3">
                        <a href="{{ route('classes.create') }}" class="btn btn-light text-primary fw-bold border-0 shadow-sm text-start">
                            <i class="fas fa-plus-circle me-2"></i> Nouvelle Classe
                        </a>
                        <a href="{{ route('tarifs.rattacher.show') }}" class="btn btn-light text-primary fw-bold border-0 shadow-sm text-start">
                            <i class="fas fa-link me-2"></i> Rattacher un Tarif
                        </a>
                        <a href="{{ route('tarifs.create') }}" class="btn btn-light text-primary fw-bold border-0 shadow-sm text-start">
                            <i class="fas fa-dollar-sign me-2"></i> Créer un Prix
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection