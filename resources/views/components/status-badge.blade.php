@props(['status'])

@php
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
@endphp

<span class="badge {{ $class }} d-inline-flex align-items-center" {{ $attributes }}>
    <i class="bi {{ $icon }} me-1"></i>
    {{ $label }}
</span>