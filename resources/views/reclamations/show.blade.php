@extends('layouts.app')

@section('title', 'Détails Réclamation')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('reclamations.index') }}">Mes Réclamations</a></li>
    <li class="breadcrumb-item active" aria-current="page">Détails</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- En-tête de la réclamation -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">{{ $reclamation->titre }}</h4>
                    <small class="text-muted">Référence : #{{ str_pad($reclamation->id, 6, '0', STR_PAD_LEFT) }}</small>
                </div>
                <x-status-badge :status="$reclamation->statut" />
            </div>
            
            <div class="card-body">
                <!-- Description -->
                <div class="mb-4">
                    <h6><i class="bi bi-card-text text-primary"></i> Description</h6>
                    <div class="bg-light p-3 rounded">
                        {{ $reclamation->description }}
                    </div>
                </div>
                
                <!-- Informations détaillées -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6><i class="bi bi-info-circle text-primary"></i> Informations</h6>
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Catégorie :</th>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $reclamation->categorie->nom }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Priorité :</th>
                                <td>
                                    @if($reclamation->priorite === 'haute')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-triangle"></i> Haute
                                        </span>
                                        <small class="text-muted ms-2">Réponse sous 24h</small>
                                    @elseif($reclamation->priorite === 'moyenne')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock"></i> Moyenne
                                        </span>
                                        <small class="text-muted ms-2">Réponse sous 3 jours</small>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-check-circle"></i> Basse
                                        </span>
                                        <small class="text-muted ms-2">Réponse sous 7 jours</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Créé le :</th>
                                <td>{{ $reclamation->created_at->format('d/m/Y à H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6><i class="bi bi-clock-history text-primary"></i> Suivi</h6>
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Statut actuel :</th>
                                <td>
                                    <x-status-badge :status="$reclamation->statut" />
                                </td>
                            </tr>
                            <tr>
                                <th>Dernière mise à jour :</th>
                                <td>{{ $reclamation->updated_at->format('d/m/Y à H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Assigné à :</th>
                                <td>
                                    @if($reclamation->assignedTo)
                                        <span class="badge bg-info">{{ $reclamation->assignedTo->name }}</span>
                                        <br>
                                        <small class="text-muted">Administrateur en charge</small>
                                    @else
                                        <span class="text-muted">En attente d'assignation</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Durée :</th>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $reclamation->created_at->diffForHumans() }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Pièces jointes -->
                @if($reclamation->piecesJointes->isNotEmpty())
                <div class="mb-4">
                    <h6><i class="bi bi-paperclip text-primary"></i> Pièces jointes</h6>
                    <div class="list-group">
                        @foreach($reclamation->piecesJointes as $piece)
                            <a href="{{ Storage::url($piece->chemin) }}"
                               target="_blank"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi {{ $piece->getIconeAttribute() }} me-2"></i>
                                    {{ $piece->nom_fichier }}
                                    <small class="text-muted ms-2">({{ strtoupper($piece->getExtensionAttribute()) }})</small>
                                </div>
                                <div>
                                    <small class="text-muted me-2">{{ $piece->created_at->format('d/m/Y') }}</small>
                                    <i class="bi bi-download"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Timeline du statut -->
            <div class="card-footer">
                <h6><i class="bi bi-activity text-primary"></i> Historique du statut</h6>
                <div class="timeline mt-3">
                    <div class="timeline-item {{ $reclamation->statut == 'en_attente' ? 'active' : 'completed' }}">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <strong>En attente</strong>
                            <div class="text-muted">Réception de la réclamation</div>
                            <small>{{ $reclamation->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>
                    
                    <div class="timeline-item {{ $reclamation->statut == 'en_cours' ? 'active' : ($reclamation->statut == 'en_attente' ? '' : 'completed') }}">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <strong>En cours</strong>
                            <div class="text-muted">Prise en charge par un administrateur</div>
                            @if($reclamation->statut == 'en_cours' || $reclamation->statut == 'resolue' || $reclamation->statut == 'fermee')
                                <small>Début : {{ $reclamation->updated_at->format('d/m/Y H:i') }}</small>
                            @endif
                        </div>
                    </div>
                    
                    <div class="timeline-item {{ $reclamation->statut == 'resolue' ? 'active' : ($reclamation->statut == 'fermee' ? 'completed' : '') }}">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <strong>Résolue</strong>
                            <div class="text-muted">Problème résolu</div>
                        </div>
                    </div>
                    
                    <div class="timeline-item {{ $reclamation->statut == 'fermee' ? 'active' : '' }}">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <strong>Fermée</strong>
                            <div class="text-muted">Dossier clos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section Commentaires -->
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-chat-left-text text-primary"></i> Commentaires</h5>
                <span class="badge bg-primary">{{ $reclamation->commentaires->count() }}</span>
            </div>
            
            <div class="card-body">
                <!-- Liste des commentaires -->
                @if($reclamation->commentaires->isEmpty())
                    <div class="text-center py-4">
                        <i class="bi bi-chat-square-text display-6 text-muted"></i>
                        <p class="mt-2 text-muted">Aucun commentaire pour le moment.</p>
                        <p class="small">Soyez le premier à commenter cette réclamation.</p>
                    </div>
                @else
                    <div class="comment-list">
                        @foreach($reclamation->commentaires->sortBy('created_at') as $commentaire)
                            <div class="comment mb-3 {{ $commentaire->user->isAdmin() ? 'border-start border-primary border-3' : '' }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="avatar {{ $commentaire->user->isAdmin() ? 'bg-primary text-white' : 'bg-light text-dark' }}">
                                            {{ substr($commentaire->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong class="{{ $commentaire->user->isAdmin() ? 'text-primary' : '' }}">
                                                    {{ $commentaire->user->name }}
                                                    @if($commentaire->user->isAdmin())
                                                        <span class="badge bg-primary ms-1">Admin</span>
                                                    @endif
                                                </strong>
                                            </div>
                                            <small class="text-muted">{{ $commentaire->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="mt-1">
                                            {{ $commentaire->contenu }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <!-- Formulaire d'ajout de commentaire -->
                <div class="comment-form mt-4">
                    <form action="{{ route('commentaires.store', $reclamation) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="contenu" class="form-label">Ajouter un commentaire</label>
                            <textarea class="form-control @error('contenu') is-invalid @enderror"
                                      id="contenu"
                                      name="contenu"
                                      rows="3"
                                      placeholder="Écrivez votre commentaire ici..."
                                      required>{{ old('contenu') }}</textarea>
                            @error('contenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Votre commentaire sera visible par les administrateurs</div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-1"></i> Envoyer le commentaire
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Actions rapides -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="bi bi-lightning"></i> Actions rapides</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('reclamations.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Retour à la liste
                    </a>
                    
                    @if($reclamation->statut === 'en_attente')
                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="bi bi-pencil"></i> Modifier la réclamation
                        </button>
                    @endif
                    
                    <a href="mailto:support@example.com?subject=Réclamation #{{ $reclamation->id }} - {{ $reclamation->titre }}" 
                       class="btn btn-outline-info">
                        <i class="bi bi-envelope"></i> Contacter le support
                    </a>
                    
                    <button class="btn btn-outline-success" onclick="window.print()">
                        <i class="bi bi-printer"></i> Imprimer cette page
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Informations de contact -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="bi bi-telephone"></i> Contact support</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        <strong>Email :</strong> ServiceClient@reclamations.com
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        <strong>Téléphone :</strong> 77 00 00 00
                    </li>
                    <li>
                        <i class="bi bi-clock me-2"></i>
                        <strong>Horaires :</strong> Dimanche-Jeudi 8h-17h
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Statistiques de cette réclamation -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-bar-chart"></i> Statistiques</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <h4 class="text-primary mb-0">{{ $reclamation->commentaires->count() }}</h4>
                            <small class="text-muted">Commentaires</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <h4 class="text-info mb-0">{{ $reclamation->piecesJointes->count() }}</h4>
                            <small class="text-muted">Fichiers joints</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <h4 class="text-warning mb-0">{{ $reclamation->created_at->diffInDays(now()) }}</h4>
                            <small class="text-muted">Jours ouverts</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <h4 class="text-success mb-0">{{ $reclamation->updated_at->diffInDays($reclamation->created_at) }}</h4>
                            <small class="text-muted">Jours de traitement</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'édition (pour le moment, juste une notification) -->
@if($reclamation->statut === 'en_attente')
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier la réclamation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>La modification des réclamations n'est pas encore implémentée.</p>
                <p>Pour le moment, vous pouvez seulement ajouter des commentaires.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif

@push('styles')
<style>
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #dee2e6;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    
    .timeline-marker {
        position: absolute;
        left: -24px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #6c757d;
        border: 2px solid white;
    }
    
    .timeline-item.active .timeline-marker {
        background: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }
    
    .timeline-item.completed .timeline-marker {
        background: #198754;
    }
    
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    
    .comment {
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    .comment:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
</style>
@endpush
@endsection