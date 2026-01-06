@extends('layouts.app')

@section('title', 'Détails Réclamation')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Détails de la réclamation -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $reclamation->titre }}</h4>
                <x-status-badge :status="$reclamation->statut" />
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6>Description :</h6>
                    <p class="text-muted">{{ $reclamation->description }}</p>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Utilisateur :</strong> {{ $reclamation->user->name }}</p>
                        <p><strong>Email :</strong> {{ $reclamation->user->email }}</p>
                        <p><strong>Catégorie :</strong> 
                            <span class="badge bg-light text-dark">{{ $reclamation->categorie->nom }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Priorité :</strong>
                            @if($reclamation->priorite === 'haute')
                                <span class="badge bg-danger">Haute</span>
                            @elseif($reclamation->priorite === 'moyenne')
                                <span class="badge bg-warning text-dark">Moyenne</span>
                            @else
                                <span class="badge bg-secondary">Basse</span>
                            @endif
                        </p>
                        <p><strong>Créé le :</strong> {{ $reclamation->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Dernière mise à jour :</strong> {{ $reclamation->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                
                <!-- Pièces jointes -->
                @if($reclamation->piecesJointes->isNotEmpty())
                    <div class="mb-4">
                        <h6>Pièces jointes :</h6>
                        <div class="list-group">
                            @foreach($reclamation->piecesJointes as $piece)
                                <a href="{{ Storage::url($piece->chemin) }}"
                                   target="_blank"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-file-earmark me-2"></i>
                                            {{ $piece->nom_fichier }}
                                        </div>
                                        <small class="text-muted">{{ $piece->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Section Commentaires -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-chat-left-text"></i> Commentaires</h5>
            </div>
            
            <div class="card-body">
                <!-- Liste des commentaires existants -->
                @if($reclamation->commentaires->isEmpty())
                    <p class="text-muted text-center py-3">Aucun commentaire pour le moment.</p>
                @else
                    <div class="comment-list mb-4">
                        @foreach($reclamation->commentaires->sortBy('created_at') as $commentaire)
                            <div class="card mb-2 {{ $commentaire->user->isAdmin() ? 'border-primary' : '' }}">
                                <div class="card-body py-2">
                                    <div class="d-flex justify-content-between">
                                        <strong class="{{ $commentaire->user->isAdmin() ? 'text-primary' : '' }}">
                                            {{ $commentaire->user->name }}
                                            @if($commentaire->user->isAdmin())
                                                <span class="badge bg-primary ms-1">Admin</span>
                                            @endif
                                        </strong>
                                        <small class="text-muted">{{ $commentaire->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <p class="mb-0 mt-1">{{ $commentaire->contenu }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <!-- Formulaire d'ajout de commentaire (admin) -->
                <div class="comment-form">
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
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Panel d'actions admin -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-gear"></i> Actions Administrateur</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.reclamations.update', $reclamation) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Modifier le statut -->
                    <div class="mb-3">
                        <label for="statut" class="form-label">Modifier le statut</label>
                        <select class="form-select @error('statut') is-invalid @enderror"
                                id="statut"
                                name="statut"
                                required>
                            <option value="en_attente" {{ $reclamation->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="en_cours" {{ $reclamation->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="resolue" {{ $reclamation->statut == 'resolue' ? 'selected' : '' }}>Résolue</option>
                            <option value="fermee" {{ $reclamation->statut == 'fermee' ? 'selected' : '' }}>Fermée</option>
                        </select>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Assigner à un admin -->
                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Assigner à</label>
                        <select class="form-select @error('assigned_to') is-invalid @enderror"
                                id="assigned_to"
                                name="assigned_to">
                            <option value="">-- Non assigné --</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}"
                                    {{ $reclamation->assigned_to == $admin->id ? 'selected' : '' }}>
                                    {{ $admin->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
                
                <!-- Informations supplémentaires -->
                <hr>
                <div class="mt-3">
                    <h6><i class="bi bi-info-circle"></i> Informations</h6>
                    <ul class="list-unstyled">
                        <li><strong>ID :</strong> {{ $reclamation->id }}</li>
                        <li><strong>Créateur :</strong> {{ $reclamation->user->name }}</li>
                        <li><strong>Email créateur :</strong> {{ $reclamation->user->email }}</li>
                        <li><strong>Commentaires :</strong> {{ $reclamation->commentaires->count() }}</li>
                        <li><strong>Pièces jointes :</strong> {{ $reclamation->piecesJointes->count() }}</li>
                    </ul>
                </div>
                
                <!-- Navigation rapide -->
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.reclamations.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection