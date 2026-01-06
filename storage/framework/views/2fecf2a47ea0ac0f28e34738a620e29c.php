<?php $__env->startSection('title', 'Mes Réclamations'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        
        
        <div class="alert alert-info mb-4">
            <h5>🔍 Debug Information:</h5>
            <div class="row">
                <div class="col-md-6">
                    <strong>User:</strong> <?php echo e(auth()->user()->name); ?><br>
                    <strong>User ID:</strong> <?php echo e(auth()->id()); ?><br>
                    <strong>Email:</strong> <?php echo e(auth()->user()->email); ?><br>
                    <strong>Rôle:</strong> <?php echo e(auth()->user()->role); ?>

                </div>
                <div class="col-md-6">
                    <?php
                        // Test direct des relations
                        $testQuery = auth()->user()->reclamations();
                        $testCount = $testQuery->count();
                        $testIds = $testQuery->pluck('id')->toArray();
                    ?>
                    <strong>Réclamations (test):</strong> <?php echo e($testCount); ?><br>
                    <strong>IDs trouvés:</strong> <?php echo e(implode(', ', $testIds) ?: 'Aucun'); ?><br>
                    <strong>Réclamations (vue):</strong> <?php echo e($reclamations->total()); ?><br>
                    <strong>Page:</strong> <?php echo e($reclamations->currentPage()); ?>/<?php echo e($reclamations->lastPage()); ?>

                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-folder2-open"></i> Mes Réclamations</h2>
            <a href="<?php echo e(route('reclamations.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nouvelle Réclamation
            </a>
        </div>

        <?php if($reclamations->isEmpty()): ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> 
                Aucune réclamation trouvée pour votre compte.
                <a href="<?php echo e(route('reclamations.create')); ?>" class="alert-link">Créez-en une maintenant</a>.
            </div>
        <?php else: ?>
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
                                <?php $__currentLoopData = $reclamations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reclamation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($reclamation->id); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('reclamations.show', $reclamation)); ?>"
                                           class="text-decoration-none fw-semibold">
                                            <?php echo e(Str::limit($reclamation->titre, 50)); ?>

                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <?php echo e($reclamation->categorie->nom ?? 'N/A'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo e($reclamation->getStatutBadgeClass()); ?>">
                                            <?php echo e($reclamation->statut); ?>

                                        </span>
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
                                    <td><?php echo e($reclamation->created_at->format('d/m/Y H:i')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('reclamations.show', $reclamation)); ?>"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="mt-3 d-flex justify-content-center">
                <?php echo e($reclamations->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-reclamations\resources\views/reclamations/index.blade.php ENDPATH**/ ?>