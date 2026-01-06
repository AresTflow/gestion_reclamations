<?php $__env->startSection('title', 'Dashboard Administration'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Administrateur</h2>
    </div>
</div>

<!-- Cartes de statistiques -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-0">Total</h6>
                        <h2 class="mb-0"><?php echo e($stats['total']); ?></h2>
                    </div>
                    <div class="fs-1">
                        <i class="bi bi-folder"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-dark bg-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-0">En Attente</h6>
                        <h2 class="mb-0"><?php echo e($stats['en_attente']); ?></h2>
                    </div>
                    <div class="fs-1">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-info shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-0">En Cours</h6>
                        <h2 class="mb-0"><?php echo e($stats['en_cours']); ?></h2>
                    </div>
                    <div class="fs-1">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-0">Résolues</h6>
                        <h2 class="mb-0"><?php echo e($stats['resolues']); ?></h2>
                    </div>
                    <div class="fs-1">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques avancées -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Réclamations par Priorité</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <div class="card bg-danger text-white mb-2">
                            <div class="card-body py-2">
                                <h4 class="mb-0"><?php echo e($stats['priorite_haute'] ?? 0); ?></h4>
                                <small>Haute</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-warning text-dark mb-2">
                            <div class="card-body py-2">
                                <h4 class="mb-0"><?php echo e($stats['priorite_moyenne'] ?? 0); ?></h4>
                                <small>Moyenne</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-secondary text-white mb-2">
                            <div class="card-body py-2">
                                <h4 class="mb-0"><?php echo e($stats['priorite_basse'] ?? 0); ?></h4>
                                <small>Basse</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-folder"></i> Statistiques Fermées</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h1 class="display-4"><?php echo e($stats['fermees'] ?? 0); ?></h1>
                    <p class="text-muted">Réclamations fermées</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-people"></i> Utilisateurs</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h1 class="display-4"><?php echo e($stats['total_users'] ?? 0); ?></h1>
                    <p class="text-muted">Utilisateurs inscrits</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Réclamations récentes -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Réclamations Récentes</h5>
                <a href="<?php echo e(route('admin.reclamations.index')); ?>" class="btn btn-sm btn-primary">
                    Voir tout <i class="bi bi-arrow-right"></i>
                </a>
            </div>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentReclamations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reclamation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($reclamation->id); ?></td>
                                    <td><?php echo e(Str::limit($reclamation->titre, 40)); ?></td>
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
                                    <td><?php echo e($reclamation->created_at->diffForHumans()); ?></td>
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
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-6"></i>
                                            <p class="mt-2">Aucune réclamation récente.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Liens rapides -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-lightning"></i> Accès Rapide</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <a href="<?php echo e(route('admin.reclamations.index')); ?>" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-list-task fs-1 d-block mb-2"></i>
                            <span>Gérer Réclamations</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-folder fs-1 d-block mb-2"></i>
                            <span>Catégories</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?php echo e(route('admin.reclamations.index')); ?>?statut=en_attente" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-clock fs-1 d-block mb-2"></i>
                            <span>En Attente <span class="badge bg-warning text-dark"><?php echo e($stats['en_attente']); ?></span></span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?php echo e(route('admin.reclamations.index')); ?>?priorite=haute" class="btn btn-outline-danger w-100 py-3">
                            <i class="bi bi-exclamation-triangle fs-1 d-block mb-2"></i>
                            <span>Haute Priorité <span class="badge bg-danger"><?php echo e($stats['priorite_haute'] ?? 0); ?></span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-reclamations\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>