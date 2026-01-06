<?php $__env->startSection('title', 'Accueil'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="jumbotron bg-light p-5 rounded-3 shadow-sm mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold text-primary">
                        <i class="bi bi-chat-square-text"></i> Système de Gestion des Réclamations
                    </h1>
                    <p class="lead mt-4">
                        Une application web complète développée avec Laravel pour gérer efficacement 
                        les réclamations clients avec suivi, traçabilité et interface administrateur.
                    </p>
                    <hr class="my-4">
                    
                    <?php if(auth()->guard()->guest()): ?>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg px-4 me-2">
                                <i class="bi bi-box-arrow-in-right"></i> Se connecter
                            </a>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary btn-lg px-4">
                                <i class="bi bi-person-plus"></i> S'inscrire
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="<?php echo e(route('reclamations.index')); ?>" class="btn btn-primary btn-lg px-4 me-2">
                                <i class="bi bi-folder2-open"></i> Mes Réclamations
                            </a>
                            <a href="<?php echo e(route('reclamations.create')); ?>" class="btn btn-success btn-lg px-4">
                                <i class="bi bi-plus-circle"></i> Nouvelle Réclamation
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 text-center">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body">
                            <i class="bi bi-chat-square-dots text-primary" style="font-size: 8rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fonctionnalités -->
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                            <i class="bi bi-send-check text-primary" style="font-size: 2.5rem;"></i>
                        </div>
                        <h4 class="card-title">Soumission Simple</h4>
                        <p class="card-text">
                            Soumettez vos réclamations avec description, catégorie, priorité et pièces jointes.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                            <i class="bi bi-graph-up text-info" style="font-size: 2.5rem;"></i>
                        </div>
                        <h4 class="card-title">Suivi en Temps Réel</h4>
                        <p class="card-text">
                            Suivez l'évolution de vos réclamations avec des statuts mis à jour en temps réel.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                            <i class="bi bi-shield-check text-success" style="font-size: 2.5rem;"></i>
                        </div>
                        <h4 class="card-title">Administration Complète</h4>
                        <p class="card-text">
                            Dashboard, filtres avancés, gestion des catégories et statistiques détaillées.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques publiques (si connecté) -->
        <?php if(auth()->guard()->check()): ?>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Vos Statistiques</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h3 class="text-primary"><?php echo e(auth()->user()->reclamations->count()); ?></h3>
                                <p class="text-muted mb-0">Total Réclamations</p>
                            </div>
                            <div class="col-md-3">
                                <h3 class="text-warning"><?php echo e(auth()->user()->reclamations->where('statut', 'en_attente')->count()); ?></h3>
                                <p class="text-muted mb-0">En Attente</p>
                            </div>
                            <div class="col-md-3">
                                <h3 class="text-info"><?php echo e(auth()->user()->reclamations->where('statut', 'en_cours')->count()); ?></h3>
                                <p class="text-muted mb-0">En Cours</p>
                            </div>
                            <div class="col-md-3">
                                <h3 class="text-success"><?php echo e(auth()->user()->reclamations->where('statut', 'resolue')->count()); ?></h3>
                                <p class="text-muted mb-0">Résolues</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-reclamations\resources\views/welcome.blade.php ENDPATH**/ ?>