<?php $__env->startSection('title', 'Nouvelle Réclamation'); ?>

<?php $__env->startSection('content'); ?>
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
                <form action="<?php echo e(route('reclamations.store')); ?>" method="POST" enctype="multipart/form-data" id="reclamationForm">
                    <?php echo csrf_field(); ?>
                    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
                    
                    <!-- Titre -->
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre de la réclamation <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control <?php $__errorArgs = ['titre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="titre"
                               name="titre"
                               value="<?php echo e(old('titre')); ?>"
                               placeholder="Ex: Problème de facturation du mois de décembre"
                               required
                               minlength="10"
                               maxlength="255">
                        <?php $__errorArgs = ['titre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-text">Minimum 10 caractères, maximum 255</div>
                    </div>
                    
                    <!-- Catégorie -->
                    <div class="mb-3">
    <label for="categorie_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
    <select class="form-select <?php $__errorArgs = ['categorie_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="categorie_id" 
            name="categorie_id" 
            required>
        <option value="">-- Sélectionnez une catégorie --</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($categorie->id); ?>" 
                    <?php echo e(old('categorie_id') == $categorie->id ? 'selected' : ''); ?>>
                <?php echo e($categorie->nom); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['categorie_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
                    
                    <!-- Priorité -->
                    <div class="mb-3">
                        <label for="priorite" class="form-label">Priorité <span class="text-danger">*</span></label>
                        <select class="form-select <?php $__errorArgs = ['priorite'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="priorite"
                                name="priorite"
                                required>
                            <option value="basse" <?php echo e(old('priorite') == 'basse' ? 'selected' : ''); ?>>🟢 Basse - Problème mineur</option>
                            <option value="moyenne" <?php echo e(old('priorite', 'moyenne') == 'moyenne' ? 'selected' : ''); ?>>🟡 Moyenne - Problème modéré</option>
                            <option value="haute" <?php echo e(old('priorite') == 'haute' ? 'selected' : ''); ?>>🔴 Haute - Problème urgent</option>
                        </select>
                        <?php $__errorArgs = ['priorite'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-text">
                            <span class="text-success">Basse</span> : Réponse sous 7 jours | 
                            <span class="text-warning">Moyenne</span> : Réponse sous 3 jours | 
                            <span class="text-danger">Haute</span> : Réponse sous 24h
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description détaillée <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  id="description"
                                  name="description"
                                  rows="6"
                                  placeholder="Décrivez votre réclamation en détail. Soyez aussi précis que possible pour nous aider à résoudre votre problème rapidement."
                                  required
                                  minlength="20"
                                  maxlength="2000"><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-text">
                            <span id="charCount">0</span> / 2000 caractères (minimum 20)
                        </div>
                    </div>
                    
                    <!-- Pièces jointes -->
                    <div class="mb-4">
                        <label for="pieces_jointes" class="form-label">Pièces jointes <span class="text-muted">(optionnel)</span></label>
                        <input type="file"
                               class="form-control <?php $__errorArgs = ['pieces_jointes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <?php $__errorArgs = ['pieces_jointes.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="pieces_jointes"
                               name="pieces_jointes[]"
                               multiple
                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                        
                        <?php $__errorArgs = ['pieces_jointes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['pieces_jointes.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        
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
                        <a href="<?php echo e(route('reclamations.index')); ?>" class="btn btn-secondary me-2">
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

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-reclamations\resources\views/reclamations/create.blade.php ENDPATH**/ ?>