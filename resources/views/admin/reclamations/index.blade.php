@extends('layouts.app')

@section('title', 'Gestion des Réclamations')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-list-task"></i> Gestion des Réclamations</h2>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </div>
        </div>

        <!-- Filtres -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.reclamations.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Statut</label>
                            <select class="form-select" name="statut">
                                <option value="">Tous les statuts</option>
                                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="resolue" {{ request('statut') == 'resolue' ? 'selected' : '' }}>Résolue</option>
                                <option value="fermee" {{ request('statut') == 'fermee' ? 'selected' : '' }}>Fermée</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Priorité</label>
                            <select class="form-select" name="priorite">
                                <option value="">Toutes priorités</option>
                                <option value="haute" {{ request('priorite') == 'haute' ? 'selected' : '' }}>Haute</option>
                                <option value="moyenne" {{ request('priorite') == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                                <option value="basse" {{ request('priorite') == 'basse' ? 'selected' : '' }}>Basse</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Recherche</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="search" 
                                   placeholder="Titre ou description..."
                                   value="{{ request('search') }}">
                        </div>
                        
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-filter"></i> Filtrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-light">
                    <div class="card-body text-center py-2">
                        <small class="text-muted">Total</small>
                        <h5 class="mb-0">{{ $stats['total'] }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning bg-opacity-25">
                    <div class="card-body text-center py-2">
                        <small class="text-muted">En attente</small>
                        <h5 class="mb-0">{{ $stats['en_attente'] }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info bg-opacity-25">
                    <div class="card-body text-center py-2">
                        <small class="text-muted">En cours</small>
                        <h5 class="mb-0">{{ $stats['en_cours'] }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success bg-opacity-25">
                    <div class="card-body text-center py-2">
                        <small class="text-muted">Résolues</small>
                        <h5 class="mb-0">{{ $stats['resolues'] }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des réclamations -->
        <div class="card shadow-sm">
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
                                <th>Assigné à</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reclamations as $reclamation)
                                <tr>
                                    <td>{{ $reclamation->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.reclamations.show', $reclamation) }}"
                                           class="text-decoration-none">
                                            {{ Str::limit($reclamation->titre, 40) }}
                                        </a>
                                    </td>
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
                                    <td>{{ $reclamation->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($reclamation->assignedTo)
                                            <span class="badge bg-info">{{ $reclamation->assignedTo->name }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
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
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-6"></i>
                                            <p class="mt-2">Aucune réclamation trouvée.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $reclamations->links() }}
        </div>
    </div>
</div>
@endsection