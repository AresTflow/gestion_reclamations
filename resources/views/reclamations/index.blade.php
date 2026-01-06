@extends('layouts.app')

@section('title', 'Mes Réclamations')

@section('content')
<div class="row">
    <div class="col-md-12">
        
        {{-- DEBUG TEMPORAIRE --}}
        <div class="alert alert-info mb-4">
            <h5>🔍 Debug Information:</h5>
            <div class="row">
                <div class="col-md-6">
                    <strong>User:</strong> {{ auth()->user()->name }}<br>
                    <strong>User ID:</strong> {{ auth()->id() }}<br>
                    <strong>Email:</strong> {{ auth()->user()->email }}<br>
                    <strong>Rôle:</strong> {{ auth()->user()->role }}
                </div>
                <div class="col-md-6">
                    @php
                        // Test direct des relations
                        $testQuery = auth()->user()->reclamations();
                        $testCount = $testQuery->count();
                        $testIds = $testQuery->pluck('id')->toArray();
                    @endphp
                    <strong>Réclamations (test):</strong> {{ $testCount }}<br>
                    <strong>IDs trouvés:</strong> {{ implode(', ', $testIds) ?: 'Aucun' }}<br>
                    <strong>Réclamations (vue):</strong> {{ $reclamations->total() }}<br>
                    <strong>Page:</strong> {{ $reclamations->currentPage() }}/{{ $reclamations->lastPage() }}
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-folder2-open"></i> Mes Réclamations</h2>
            <a href="{{ route('reclamations.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nouvelle Réclamation
            </a>
        </div>

        @if($reclamations->isEmpty())
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> 
                Aucune réclamation trouvée pour votre compte.
                <a href="{{ route('reclamations.create') }}" class="alert-link">Créez-en une maintenant</a>.
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Titre</th>
                                    <th>Catégorie</th>
                                    <th>Statut</th>
                                    <th>Priorité</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reclamations as $reclamation)
                                <tr>
                                    <td>{{ $reclamation->id }}</td>
                                    <td>
                                        <a href="{{ route('reclamations.show', $reclamation) }}"
                                           class="text-decoration-none fw-semibold">
                                            {{ Str::limit($reclamation->titre, 50) }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $reclamation->categorie->nom ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $reclamation->getStatutBadgeClass() }}">
                                            {{ $reclamation->statut }}
                                        </span>
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
                                    <td>{{ $reclamation->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('reclamations.show', $reclamation) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="mt-3 d-flex justify-content-center">
                {{ $reclamations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection