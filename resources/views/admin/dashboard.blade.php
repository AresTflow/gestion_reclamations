@extends('layouts.app')

@section('title', 'Dashboard Administration')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Administrateur</h2>
    </div>
</div>

<!-- Cartes de statistiques -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-0">Total</h6>
                        <h2 class="mb-0">{{ $stats['total'] }}</h2>
                    </div>
                    <div class="fs-1">
                        <i class="bi bi-folder"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-dark bg-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-0">En Attente</h6>
                        <h2 class="mb-0">{{ $stats['en_attente'] }}</h2>
                    </div>
                    <div class="fs-1">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-info shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-0">En Cours</h6>
                        <h2 class="mb-0">{{ $stats['en_cours'] }}</h2>
                    </div>
                    <div class="fs-1">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-0">Résolues</h6>
                        <h2 class="mb-0">{{ $stats['resolues'] }}</h2>
                    </div>
                    <div class="fs-1">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques avancées -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Réclamations par Priorité</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <div class="card bg-danger text-white mb-2">
                            <div class="card-body py-2">
                                <h4 class="mb-0">{{ $stats['priorite_haute'] ?? 0 }}</h4>
                                <small>Haute</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-warning text-dark mb-2">
                            <div class="card-body py-2">
                                <h4 class="mb-0">{{ $stats['priorite_moyenne'] ?? 0 }}</h4>
                                <small>Moyenne</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-secondary text-white mb-2">
                            <div class="card-body py-2">
                                <h4 class="mb-0">{{ $stats['priorite_basse'] ?? 0 }}</h4>
                                <small>Basse</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-folder"></i> Statistiques Fermées</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h1 class="display-4">{{ $stats['fermees'] ?? 0 }}</h1>
                    <p class="text-muted">Réclamations fermées</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-people"></i> Utilisateurs</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h1 class="display-4">{{ $stats['total_users'] ?? 0 }}</h1>
                    <p class="text-muted">Utilisateurs inscrits</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Réclamations récentes -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Réclamations Récentes</h5>
                <a href="{{ route('admin.reclamations.index') }}" class="btn btn-sm btn-primary">
                    Voir tout <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Utilisateur</th>
                                <th>Catégorie</th>
                                <th>Statut</th>
                                <th>Priorité</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReclamations as $reclamation)
                                <tr>
                                    <td>{{ $reclamation->id }}</td>
                                    <td>{{ Str::limit($reclamation->titre, 40) }}</td>
                                    <td>{{ $reclamation->user->name }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $reclamation->categorie->nom }}
                                        </span>
                                    </td>
                                    <td>
                                        <x-status-badge :status="$reclamation->statut" />
                                    </td>
                                    <td>
                                        @if($reclamation->priorite === 'haute')
                                            <span class="badge bg-danger">Haute</span>
                                        @elseif($reclamation->priorite === 'moyenne')
                                            <span class="badge bg-warning text-dark">Moyenne</span>
                                        @else
                                            <span class="badge bg-secondary">Basse</span>
                                        @endif
                                    </td>
                                    <td>{{ $reclamation->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('admin.reclamations.show', $reclamation) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Voir détails">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-6"></i>
                                            <p class="mt-2">Aucune réclamation récente.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Liens rapides -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-lightning"></i> Accès Rapide</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.reclamations.index') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-list-task fs-1 d-block mb-2"></i>
                            <span>Gérer Réclamations</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-folder fs-1 d-block mb-2"></i>
                            <span>Catégories</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.reclamations.index') }}?statut=en_attente" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-clock fs-1 d-block mb-2"></i>
                            <span>En Attente <span class="badge bg-warning text-dark">{{ $stats['en_attente'] }}</span></span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.reclamations.index') }}?priorite=haute" class="btn btn-outline-danger w-100 py-3">
                            <i class="bi bi-exclamation-triangle fs-1 d-block mb-2"></i>
                            <span>Haute Priorité <span class="badge bg-danger">{{ $stats['priorite_haute'] ?? 0 }}</span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection