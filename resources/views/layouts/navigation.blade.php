<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <!-- Logo / Brand -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="bi bi-chat-square-text fs-4 me-2"></i>
            <span class="fw-bold">{{ config('app.name', 'Réclamations') }}</span>
        </a>

        <!-- Toggle button pour mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu principal -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                    <!-- Liens pour utilisateurs connectés -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reclamations.index') ? 'active' : '' }}"
                           href="{{ route('reclamations.index') }}">
                            <i class="bi bi-folder2-open me-1"></i> Mes Réclamations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reclamations.create') ? 'active' : '' }}"
                           href="{{ route('reclamations.create') }}">
                            <i class="bi bi-plus-circle me-1"></i> Nouvelle Réclamation
                        </a>
                    </li>

                    <!-- Liens Admin (seulement pour les administrateurs) -->
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                               href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-shield-lock me-1"></i> Administration
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.reclamations.index') }}">
                                        <i class="bi bi-list-task me-2"></i> Gérer Réclamations
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.categories.index') }}">
                                        <i class="bi bi-folder me-2"></i> Catégories
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-people me-2"></i> Utilisateurs
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Partie droite (connexion/déconnexion) -->
            <ul class="navbar-nav">
                @guest
                    <!-- Liens pour invités (Laravel UI) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                           href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                        </a>
                    </li>
                    
                    @if(Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                               href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i> Inscription
                            </a>
                        </li>
                    @endif
                @else
                    <!-- Menu utilisateur connecté (Laravel UI) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ Auth::user()->name }}
                            @if(Auth::user()->isAdmin())
                                <span class="badge bg-warning text-dark ms-1">Admin</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person me-2"></i> Mon Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('reclamations.index') }}">
                                    <i class="bi bi-folder2-open me-2"></i> Mes Réclamations
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <!-- Déconnexion Laravel UI -->
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                </a>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Breadcrumbs (fil d'Ariane) -->
@if(!request()->routeIs('welcome') && !request()->routeIs('home'))
<nav aria-label="breadcrumb" class="bg-light py-2 border-bottom">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Accueil</a>
            </li>
            @yield('breadcrumb', '')
        </ol>
    </div>
</nav>
@endif
