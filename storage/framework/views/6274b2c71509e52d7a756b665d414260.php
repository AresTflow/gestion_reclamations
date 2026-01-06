<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['status']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Classes CSS pour chaque statut
    $classes = [
        'en_attente' => 'bg-warning text-dark',
        'en_cours'   => 'bg-info text-white',
        'resolue'    => 'bg-success text-white',
        'fermee'     => 'bg-secondary text-white'
    ];
    
    // Labels en français
    $labels = [
        'en_attente' => 'En attente',
        'en_cours'   => 'En cours',
        'resolue'    => 'Résolue',
        'fermee'     => 'Fermée'
    ];
    
    // Icônes Bootstrap
    $icons = [
        'en_attente' => 'bi-clock',
        'en_cours'   => 'bi-arrow-repeat',
        'resolue'    => 'bi-check-circle',
        'fermee'     => 'bi-archive'
    ];
    
    // Valeurs par défaut si statut inconnu
    $class = $classes[$status] ?? 'bg-secondary text-white';
    $label = $labels[$status] ?? $status;
    $icon = $icons[$status] ?? 'bi-question-circle';
?>

<span class="badge <?php echo e($class); ?> d-inline-flex align-items-center" <?php echo e($attributes); ?>>
    <i class="bi <?php echo e($icon); ?> me-1"></i>
    <?php echo e($label); ?>

</span><?php /**PATH C:\xampp\htdocs\gestion-reclamations\resources\views/components/status-badge.blade.php ENDPATH**/ ?>