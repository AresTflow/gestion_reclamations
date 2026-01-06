<?php $__env->startSection('title', 'Détails Réclamation'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <!-- Détails de la réclamation -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><?php echo e($reclamation->titre); ?></h4>
                <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $reclamation->statut]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($reclamation->statut)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6>Description :</h6>
                    <p class="text-muted"><?php echo e($reclamation->description); ?></p>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Utilisateur :</strong> <?php echo e($reclamation->user->name); ?></p>
                        <p><strong>Email :</strong> <?php echo e($reclamation->user->email); ?></p>
                        <p><strong>Catégorie :</strong> 
                            <span class="badge bg-light text-dark"><?php echo e($reclamation->categorie->nom); ?></span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Priorité :</strong>
                            <?php if($reclamation->priorite === 'haute'): ?>
                                <span class="badge bg-danger">Haute</span>
                            <?php elseif($reclamation->priorite === 'moyenne'): ?>
                                <span class="badge bg-warning text-dark">Moyenne</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Basse</span>
                            <?php endif; ?>
                        </p>
                        <p><strong>Créé le :</strong> <?php echo e($reclamation->created_at->format('d/m/Y H:i')); ?></p>
                        <p><strong>Dernière mise à jour :</strong> <?php echo e($reclamation->updated_at->format('d/m/Y H:i')); ?></p>
                    </div>
                </div>
                
                <!-- Pièces jointes -->
                <?php if($reclamation->piecesJointes->isNotEmpty()): ?>
                    <div class="mb-4">
                        <h6>Pièces jointes :</h6>
                        <div class="list-group">
                            <?php $__currentLoopData = $reclamation->piecesJointes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piece): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(Storage::url($piece->chemin)); ?>"
                                   target="_blank"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-file-earmark me-2"></i>
                                            <?php echo e($piece->nom_fichier); ?>

                                        </div>
                                        <small class="text-muted"><?php echo e($piece->created_at->format('d/m/Y H:i')); ?></small>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Section Commentaires -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-chat-left-text"></i> Commentaires</h5>
            </div>
            
            <div class="card-body">
                <!-- Liste des commentaires existants -->
                <?php if($reclamation->commentaires->isEmpty()): ?>
                    <p class="text-muted text-center py-3">Aucun commentaire pour le moment.</p>
                <?php else: ?>
                    <div class="comment-list mb-4">
                        <?php $__currentLoopData = $reclamation->commentaires->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card mb-2 <?php echo e($commentaire->user->isAdmin() ? 'border-primary' : ''); ?>">
                                <div class="card-body py-2">
                                    <div class="d-flex justify-content-between">
                                        <strong class="<?php echo e($commentaire->user->isAdmin() ? 'text-primary' : ''); ?>">
                                            <?php echo e($commentaire->user->name); ?>

                                            <?php if($commentaire->user->isAdmin()): ?>
                                                <span class="badge bg-primary ms-1">Admin</span>
                                            <?php endif; ?>
                                        </strong>
                                        <small class="text-muted"><?php echo e($commentaire->created_at->format('d/m/Y H:i')); ?></small>
                                    </div>
                                    <p class="mb-0 mt-1"><?php echo e($commentaire->contenu); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Formulaire d'ajout de commentaire (admin) -->
                <div class="comment-form">
                    <form action="<?php echo e(route('commentaires.store', $reclamation)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label for="contenu" class="form-label">Ajouter un commentaire</label>
                            <textarea class="form-control <?php $__errorArgs = ['contenu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      id="contenu"
                                      name="contenu"
                                      rows="3"
                                      placeholder="Écrivez votre commentaire ici..."
                                      required><?php echo e(old('contenu')); ?></textarea>
                            <?php $__errorArgs = ['contenu'];
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
                <form action="<?php echo e(route('admin.reclamations.update', $reclamation)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <!-- Modifier le statut -->
                    <div class="mb-3">
                        <label for="statut" class="form-label">Modifier le statut</label>
                        <select class="form-select <?php $__errorArgs = ['statut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="statut"
                                name="statut"
                                required>
                            <option value="en_attente" <?php echo e($reclamation->statut == 'en_attente' ? 'selected' : ''); ?>>En attente</option>
                            <option value="en_cours" <?php echo e($reclamation->statut == 'en_cours' ? 'selected' : ''); ?>>En cours</option>
                            <option value="resolue" <?php echo e($reclamation->statut == 'resolue' ? 'selected' : ''); ?>>Résolue</option>
                            <option value="fermee" <?php echo e($reclamation->statut == 'fermee' ? 'selected' : ''); ?>>Fermée</option>
                        </select>
                        <?php $__errorArgs = ['statut'];
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
                    
                    <!-- Assigner à un admin -->
                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Assigner à</label>
                        <select class="form-select <?php $__errorArgs = ['assigned_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="assigned_to"
                                name="assigned_to">
                            <option value="">-- Non assigné --</option>
                            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($admin->id); ?>"
                                    <?php echo e($reclamation->assigned_to == $admin->id ? 'selected' : ''); ?>>
                                    <?php echo e($admin->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['assigned_to'];
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
                        <li><strong>ID :</strong> <?php echo e($reclamation->id); ?></li>
                        <li><strong>Créateur :</strong> <?php echo e($reclamation->user->name); ?></li>
                        <li><strong>Email créateur :</strong> <?php echo e($reclamation->user->email); ?></li>
                        <li><strong>Commentaires :</strong> <?php echo e($reclamation->commentaires->count()); ?></li>
                        <li><strong>Pièces jointes :</strong> <?php echo e($reclamation->piecesJointes->count()); ?></li>
                    </ul>
                </div>
                
                <!-- Navigation rapide -->
                <hr>
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('admin.reclamations.index')); ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-reclamations\resources\views/admin/reclamations/show.blade.php ENDPATH**/ ?>