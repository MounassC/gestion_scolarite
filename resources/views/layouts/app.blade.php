<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Scolarité</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Style pour rendre le lien actif plus visible */
        .nav-link.active {
            font-weight: bold;
            border-bottom: 2px solid white;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="fas fa-graduation-cap me-2"></i>Gestion Scolarité
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto"> {{-- ms-auto pousse le menu à droite pour plus d'espace --}}
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('filieres.*') ? 'active' : '' }}" href="{{ route('filieres.index') }}">
                        <i class="fas fa-book me-1"></i> Filières
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}" href="{{ route('classes.index') }}">
                        <i class="fas fa-chalkboard-teacher me-1"></i> Classes
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tarifs.*') ? 'active' : '' }}" href="{{ route('tarifs.index') }}">
                        <i class="fas fa-money-bill-wave me-1"></i> Tarifs
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="fas fa-layer-group me-1"></i> Catégories
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('niveaux.*') ? 'active' : '' }}" href="{{ route('niveaux.index') }}">
                        <i class="fas fa-level-up-alt me-1"></i> Niveaux
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('annees.*') ? 'active' : '' }}" href="{{ route('annees.index') }}">
                        <i class="fas fa-calendar-alt me-1"></i> Années
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>