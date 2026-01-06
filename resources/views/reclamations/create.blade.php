@extends('layouts.app')

@section('title', 'Nouvelle Réclamation')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-plus fs-4 me-2"></i>
                    <h4 class="mb-0">Nouvelle Réclamation</h4>
                </div>
            </div>
            
            <div class="card-body">
                <form action="{{ route('reclamations.store') }}" method="POST" enctype="multipart/form-data" id="reclamationForm">
                    @csrf
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    
                    <!-- Titre -->
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre de la réclamation <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('titre') is-invalid @enderror"
                               id="titre"
                               name="titre"
                               value="{{ old('titre') }}"
                               placeholder="Ex: Problème de facturation du mois de décembre"
                               required
                               minlength="10"
                               maxlength="255">
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Minimum 10 caractères, maximum 255</div>
                    </div>
                    
                    <!-- Catégorie -->
                    <div class="mb-3">
    <label for="categorie_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
    <select class="form-select @error('categorie_id') is-invalid @enderror" 
            id="categorie_id" 
            name="categorie_id" 
            required>
        <option value="">-- Sélectionnez une catégorie --</option>
        @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}" 
                    {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                {{ $categorie->nom }}
            </option>
        @endforeach
    </select>
    @error('categorie_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                    
                    <!-- Priorité -->
                    <div class="mb-3">
                        <label for="priorite" class="form-label">Priorité <span class="text-danger">*</span></label>
                        <select class="form-select @error('priorite') is-invalid @enderror"
                                id="priorite"
                                name="priorite"
                                required>
                            <option value="basse" {{ old('priorite') == 'basse' ? 'selected' : '' }}>🟢 Basse - Problème mineur</option>
                            <option value="moyenne" {{ old('priorite', 'moyenne') == 'moyenne' ? 'selected' : '' }}>🟡 Moyenne - Problème modéré</option>
                            <option value="haute" {{ old('priorite') == 'haute' ? 'selected' : '' }}>🔴 Haute - Problème urgent</option>
                        </select>
                        @error('priorite')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span class="text-success">Basse</span> : Réponse sous 7 jours | 
                            <span class="text-warning">Moyenne</span> : Réponse sous 3 jours | 
                            <span class="text-danger">Haute</span> : Réponse sous 24h
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description détaillée <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="6"
                                  placeholder="Décrivez votre réclamation en détail. Soyez aussi précis que possible pour nous aider à résoudre votre problème rapidement."
                                  required
                                  minlength="20"
                                  maxlength="2000">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span id="charCount">0</span> / 2000 caractères (minimum 20)
                        </div>
                    </div>
                    
                    <!-- Pièces jointes -->
                    <div class="mb-4">
                        <label for="pieces_jointes" class="form-label">Pièces jointes <span class="text-muted">(optionnel)</span></label>
                        <input type="file"
                               class="form-control @error('pieces_jointes') is-invalid @enderror @error('pieces_jointes.*') is-invalid @enderror"
                               id="pieces_jointes"
                               name="pieces_jointes[]"
                               multiple
                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                        
                        @error('pieces_jointes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('pieces_jointes.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <div class="form-text">
                            <ul class="mb-1">
                                <li>Formats acceptés : PDF, JPG, PNG, DOC, DOCX</li>
                                <li>Taille maximum par fichier : 2MB</li>
                                <li>Maximum 5 fichiers</li>
                            </ul>
                            <div id="filePreview" class="mt-2"></div>
                        </div>
                    </div>
                    
                    <!-- Boutons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-3">
                        <a href="{{ route('reclamations.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="bi bi-send"></i> Soumettre la réclamation
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Conseils -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="bi bi-lightbulb"></i> Conseils pour une bonne réclamation</h6>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li><strong>Soyez précis</strong> : Indiquez les dates, numéros de facture, références produit</li>
                    <li><strong>Fournissez des preuves</strong> : Ajoutez des captures d'écran, photos ou documents</li>
                    <li><strong>Choisissez la bonne priorité</strong> : Cela nous aide à traiter votre demande dans les délais appropriés</li>
                    <li><strong>Vérifiez vos informations</strong> : Assurez-vous que tous les champs obligatoires sont remplis</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Compteur de caractères pour la description
    document.getElementById('description').addEventListener('input', function() {
        const charCount = this.value.length;
        document.getElementById('charCount').textContent = charCount;
        
        if (charCount < 20) {
            document.getElementById('charCount').className = 'text-danger';
        } else if (charCount > 1800) {
            document.getElementById('charCount').className = 'text-warning';
        } else {
            document.getElementById('charCount').className = 'text-success';
        }
    });
    
    // Aperçu des fichiers sélectionnés
    document.getElementById('pieces_jointes').addEventListener('change', function(e) {
        const preview = document.getElementById('filePreview');
        preview.innerHTML = '';
        
        if (this.files.length > 5) {
            preview.innerHTML = '<div class="alert alert-danger">Maximum 5 fichiers autorisés</div>';
            this.value = '';
            return;
        }
        
        Array.from(this.files).forEach((file, index) => {
            if (file.size > 2 * 1024 * 1024) {
                preview.innerHTML += `<div class="alert alert-danger">${file.name} dépasse 2MB</div>`;
                return;
            }
            
            const fileInfo = document.createElement('div');
            fileInfo.className = 'alert alert-light d-flex justify-content-between align-items-center';
            fileInfo.innerHTML = `
                <div>
                    <i class="bi bi-file-earmark me-2"></i>
                    ${file.name} (${(file.size / 1024).toFixed(1)} KB)
                </div>
                <button type="button" class="btn-close" onclick="removeFile(${index})"></button>
            `;
            preview.appendChild(fileInfo);
        });
    });
    
    function removeFile(index) {
        const dt = new DataTransfer();
        const input = document.getElementById('pieces_jointes');
        const { files } = input;
        
        for (let i = 0; i < files.length; i++) {
            if (index !== i) {
                dt.items.add(files[i]);
            }
        }
        
        input.files = dt.files;
        input.dispatchEvent(new Event('change'));
    }
    
    // Validation avant soumission
    document.getElementById('reclamationForm').addEventListener('submit', function(e) {
        const titre = document.getElementById('titre').value;
        const description = document.getElementById('description').value;
        
        if (titre.length < 10) {
            e.preventDefault();
            alert('Le titre doit contenir au moins 10 caractères');
            return;
        }
        
        if (description.length < 20) {
            e.preventDefault();
            alert('La description doit contenir au moins 20 caractères');
            return;
        }
        
        // Désactiver le bouton pour éviter les doubles clics
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('submitBtn').innerHTML = '<i class="bi bi-hourglass-split"></i> Envoi en cours...';
    });
</script>
@endpush
@endsection