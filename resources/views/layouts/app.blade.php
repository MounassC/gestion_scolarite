<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Scolarité</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Style général des liens du menu */
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important; /* Blanc presque pur pour tous */
            font-weight: 500;
            padding: 10px 15px !important;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        /* Style des icônes (on leur donne des couleurs spécifiques) */
        .nav-link i {
            font-size: 1.1rem;
            padding: 8px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15); /* Petit fond léger derrière l'icône */
            margin-right: 10px;
        }

        /* Effet au survol (Hover) */
        .navbar-nav .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            transform: translateY(-2px); /* Petit saut vers le haut */
        }

        /* Style quand le lien est ACTIF */
        .nav-link.active {
            color: #fff !important;
            background: rgba(0, 0, 0, 0.2) !important; /* Fond plus sombre pour marquer la position */
            border-radius: 8px;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <i class="fas fa-graduation-cap me-2"></i>Scolarité
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                
                {{-- LIEN DASHBOARD --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-1"></i> Dashboard
                    </a>
                </li>

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
                
                {{-- MENU DÉROULANT TARIFICATION --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('tarifs.*') ? 'active' : '' }}" href="#" id="tarifDrop" data-bs-toggle="dropdown">
                        <i class="fas fa-money-bill-wave me-1"></i> Tarifs
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('tarifs.index') }}">Catalogue des prix</a></li>
                        <li><a class="dropdown-item" href="{{ route('tarifs.rattacher.show') }}">Rattacher à une classe</a></li>
                    </ul>
                </li>
                
                {{-- MENU DÉROULANT CONFIGURATION (Regroupe les petits modules) --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('categories.*', 'niveaux.*', 'annees.*') ? 'active' : '' }}" href="#" id="configDrop" data-bs-toggle="dropdown">
                        <i class="fas fa-cogs me-1"></i> Configuration
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('categories.index') }}">Catégories</a></li>
                        <li><a class="dropdown-item" href="{{ route('niveaux.index') }}">Niveaux</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('annees.index') }}">Années Scolaires</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>