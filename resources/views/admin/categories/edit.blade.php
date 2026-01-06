@extends('layouts.app')

@section('title', 'Modifier Catégorie')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Modifier Catégorie</h4>
            </div>
            
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $categorie) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Champ Nom -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de la catégorie <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('nom') is-invalid @enderror"
                               id="nom"
                               name="nom"
                               value="{{ old('nom', $categorie->nom) }}"
                               placeholder="Ex: Facturation"
                               required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Champ Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="3"
                                  placeholder="Description de la catégorie...">{{ old('description', $categorie->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Optionnel - maximum 500 caractères</div>
                    </div>
                    
                    <!-- Statistiques (informatives) -->
                    <div class="alert alert-info">
                        <h6><i class="bi bi-info-circle"></i> Informations</h6>
                        <p class="mb-1">Cette catégorie contient <strong>{{ $categorie->reclamations_count ?? $categorie->reclamations()->count() }}</strong> réclamation(s).</p>
                        <p class="mb-0">Créée le : {{ $categorie->created_at->format('d/m/Y') }}</p>
                    </div>
                    
                    <!-- Boutons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Mettre à jour
                        </button>
                    </div>
                </form>
                
                <!-- Bouton Supprimer (séparé) -->
                @if(($categorie->reclamations_count ?? $categorie->reclamations()->count()) == 0)
                <hr>
                <form action="{{ route('admin.categories.destroy', $categorie) }}" method="POST" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Supprimer cette catégorie
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection