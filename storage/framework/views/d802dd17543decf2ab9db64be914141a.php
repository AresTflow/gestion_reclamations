<?php $__env->startSection('title', 'Gestion des Réclamations'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-list-task"></i> Gestion des Réclamations</h2>
            <div>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </div>
        </div>

        <!-- Filtres -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('admin.reclamations.index')); ?>">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Statut</label>
                            <select class="form-select" name="statut">
                                <option value="">Tous les statuts</option>
                                <option value="en_attente" <?php echo e(request('statut') == 'en_attente' ? 'selected' : ''); ?>>En attente</option>
                                <option value="en_cours" <?php echo e(request('statut') == 'en_cours' ? 'selected' : ''); ?>>En cours</option>
                                <option value="resolue" <?php echo e(request('statut') == 'resolue' ? 'selected' : ''); ?>>Résolue</option>
                                <option value="fermee" <?php echo e(request('statut') == 'fermee' ? 'selected' : ''); ?>>Fermée</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Priorité</label>
                            <select class="form-select" name="priorite">
                                <option value="">Toutes priorités</option>
                                <option value="haute" <?php echo e(request('priorite') == 'haute' ? 'selected' : ''); ?>>Haute</option>
                                <option value="moyenne" <?php echo e(request('priorite') == 'moyenne' ? 'selected' : ''); ?>>Moyenne</option>
                                <option value="basse" <?php echo e(request('priorite') == 'basse' ? 'selected' : ''); ?>>Basse</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Recherche</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="search" 
                                   placeholder="Titre ou description..."
                                   value="<?php echo e(request('search')); ?>">
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
                        <h5 class="mb-0"><?php echo e($stats['total']); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning bg-opacity-25">
                    <div class="card-body text-center py-2">
                        <small class="text-muted">En attente</small>
                        <h5 class="mb-0"><?php echo e($stats['en_attente']); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info bg-opacity-25">
                    <div class="card-body text-center py-2">
                        <small class="text-muted">En cours</small>
                        <h5 class="mb-0"><?php echo e($stats['en_cours']); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success bg-opacity-25">
                    <div class="card-body text-center py-2">
                        <small class="text-muted">Résolues</small>
                        <h5 class="mb-0"><?php echo e($stats['resolues']); ?></h5>
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
                            <?php $__empty_1 = true; $__currentLoopData = $reclamations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reclamation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($reclamation->id); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.reclamations.show', $reclamation)); ?>"
                                           class="text-decoration-none">
                                            <?php echo e(Str::limit($reclamation->titre, 40)); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($reclamation->user->name); ?></td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <?php echo e($reclamation->categorie->nom); ?>

                                        </span>
                                    </td>
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
                                    <td>
                                        <?php if($reclamation->priorite === 'haute'): ?>
                                            <span class="badge bg-danger">Haute</span>
                                        <?php elseif($reclamation->priorite === 'moyenne'): ?>
                                            <span class="badge bg-warning text-dark">Moyenne</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Basse</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($reclamation->created_at->format('d/m/Y')); ?></td>
                                    <td>
                                        <?php if($reclamation->assignedTo): ?>
                                            <span class="badge bg-info"><?php echo e($reclamation->assignedTo->name); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.reclamations.show', $reclamation)); ?>"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Voir détails">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-6"></i>
                                            <p class="mt-2">Aucune réclamation trouvée.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <?php echo e($reclamations->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-reclamations\resources\views/admin/reclamations/index.blade.php ENDPATH**/ ?>