<?php $__env->startSection('title', 'Détails Réclamation'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('reclamations.index')); ?>">Mes Réclamations</a></li>
    <li class="breadcrumb-item active" aria-current="page">Détails</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <!-- En-tête de la réclamation -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0"><?php echo e($reclamation->titre); ?></h4>
                    <small class="text-muted">Référence : #<?php echo e(str_pad($reclamation->id, 6, '0', STR_PAD_LEFT)); ?></small>
                </div>
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
                <!-- Description -->
                <div class="mb-4">
                    <h6><i class="bi bi-card-text text-primary"></i> Description</h6>
                    <div class="bg-light p-3 rounded">
                        <?php echo e($reclamation->description); ?>

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
                                        <?php echo e($reclamation->categorie->nom); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Priorité :</th>
                                <td>
                                    <?php if($reclamation->priorite === 'haute'): ?>
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-triangle"></i> Haute
                                        </span>
                                        <small class="text-muted ms-2">Réponse sous 24h</small>
                                    <?php elseif($reclamation->priorite === 'moyenne'): ?>
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock"></i> Moyenne
                                        </span>
                                        <small class="text-muted ms-2">Réponse sous 3 jours</small>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-check-circle"></i> Basse
                                        </span>
                                        <small class="text-muted ms-2">Réponse sous 7 jours</small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Créé le :</th>
                                <td><?php echo e($reclamation->created_at->format('d/m/Y à H:i')); ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6><i class="bi bi-clock-history text-primary"></i> Suivi</h6>
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Statut actuel :</th>
                                <td>
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
                                </td>
                            </tr>
                            <tr>
                                <th>Dernière mise à jour :</th>
                                <td><?php echo e($reclamation->updated_at->format('d/m/Y à H:i')); ?></td>
                            </tr>
                            <tr>
                                <th>Assigné à :</th>
                                <td>
                                    <?php if($reclamation->assignedTo): ?>
                                        <span class="badge bg-info"><?php echo e($reclamation->assignedTo->name); ?></span>
                                        <br>
                                        <small class="text-muted">Administrateur en charge</small>
                                    <?php else: ?>
                                        <span class="text-muted">En attente d'assignation</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Durée :</th>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <?php echo e($reclamation->created_at->diffForHumans()); ?>

                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Pièces jointes -->
                <?php if($reclamation->piecesJointes->isNotEmpty()): ?>
                <div class="mb-4">
                    <h6><i class="bi bi-paperclip text-primary"></i> Pièces jointes</h6>
                    <div class="list-group">
                        <?php $__currentLoopData = $reclamation->piecesJointes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piece): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(Storage::url($piece->chemin)); ?>"
                               target="_blank"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi <?php echo e($piece->getIconeAttribute()); ?> me-2"></i>
                                    <?php echo e($piece->nom_fichier); ?>

                                    <small class="text-muted ms-2">(<?php echo e(strtoupper($piece->getExtensionAttribute())); ?>)</small>
                                </div>
                                <div>
                                    <small class="text-muted me-2"><?php echo e($piece->created_at->format('d/m/Y')); ?></small>
                                    <i class="bi bi-download"></i>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Timeline du statut -->
            <div class="card-footer">
                <h6><i class="bi bi-activity text-primary"></i> Historique du statut</h6>
                <div class="timeline mt-3">
                    <div class="timeline-item <?php echo e($reclamation->statut == 'en_attente' ? 'active' : 'completed'); ?>">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <strong>En attente</strong>
                            <div class="text-muted">Réception de la réclamation</div>
                            <small><?php echo e($reclamation->created_at->format('d/m/Y H:i')); ?></small>
                        </div>
                    </div>
                    
                    <div class="timeline-item <?php echo e($reclamation->statut == 'en_cours' ? 'active' : ($reclamation->statut == 'en_attente' ? '' : 'completed')); ?>">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <strong>En cours</strong>
                            <div class="text-muted">Prise en charge par un administrateur</div>
                            <?php if($reclamation->statut == 'en_cours' || $reclamation->statut == 'resolue' || $reclamation->statut == 'fermee'): ?>
                                <small>Début : <?php echo e($reclamation->updated_at->format('d/m/Y H:i')); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="timeline-item <?php echo e($reclamation->statut == 'resolue' ? 'active' : ($reclamation->statut == 'fermee' ? 'completed' : '')); ?>">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <strong>Résolue</strong>
                            <div class="text-muted">Problème résolu</div>
                        </div>
                    </div>
                    
                    <div class="timeline-item <?php echo e($reclamation->statut == 'fermee' ? 'active' : ''); ?>">
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
                <span class="badge bg-primary"><?php echo e($reclamation->commentaires->count()); ?></span>
            </div>
            
            <div class="card-body">
                <!-- Liste des commentaires -->
                <?php if($reclamation->commentaires->isEmpty()): ?>
                    <div class="text-center py-4">
                        <i class="bi bi-chat-square-text display-6 text-muted"></i>
                        <p class="mt-2 text-muted">Aucun commentaire pour le moment.</p>
                        <p class="small">Soyez le premier à commenter cette réclamation.</p>
                    </div>
                <?php else: ?>
                    <div class="comment-list">
                        <?php $__currentLoopData = $reclamation->commentaires->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="comment mb-3 <?php echo e($commentaire->user->isAdmin() ? 'border-start border-primary border-3' : ''); ?>">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="avatar <?php echo e($commentaire->user->isAdmin() ? 'bg-primary text-white' : 'bg-light text-dark'); ?>">
                                            <?php echo e(substr($commentaire->user->name, 0, 1)); ?>

                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong class="<?php echo e($commentaire->user->isAdmin() ? 'text-primary' : ''); ?>">
                                                    <?php echo e($commentaire->user->name); ?>

                                                    <?php if($commentaire->user->isAdmin()): ?>
                                                        <span class="badge bg-primary ms-1">Admin</span>
                                                    <?php endif; ?>
                                                </strong>
                                            </div>
                                            <small class="text-muted"><?php echo e($commentaire->created_at->format('d/m/Y H:i')); ?></small>
                                        </div>
                                        <div class="mt-1">
                                            <?php echo e($commentaire->contenu); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Formulaire d'ajout de commentaire -->
                <div class="comment-form mt-4">
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
                    <a href="<?php echo e(route('reclamations.index')); ?>" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Retour à la liste
                    </a>
                    
                    <?php if($reclamation->statut === 'en_attente'): ?>
                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="bi bi-pencil"></i> Modifier la réclamation
                        </button>
                    <?php endif; ?>
                    
                    <a href="mailto:support@example.com?subject=Réclamation #<?php echo e($reclamation->id); ?> - <?php echo e($reclamation->titre); ?>" 
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
                            <h4 class="text-primary mb-0"><?php echo e($reclamation->commentaires->count()); ?></h4>
                            <small class="text-muted">Commentaires</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <h4 class="text-info mb-0"><?php echo e($reclamation->piecesJointes->count()); ?></h4>
                            <small class="text-muted">Fichiers joints</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <h4 class="text-warning mb-0"><?php echo e($reclamation->created_at->diffInDays(now())); ?></h4>
                            <small class="text-muted">Jours ouverts</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <h4 class="text-success mb-0"><?php echo e($reclamation->updated_at->diffInDays($reclamation->created_at)); ?></h4>
                            <small class="text-muted">Jours de traitement</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'édition (pour le moment, juste une notification) -->
<?php if($reclamation->statut === 'en_attente'): ?>
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
<?php endif; ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-reclamations\resources\views/reclamations/show.blade.php ENDPATH**/ ?>