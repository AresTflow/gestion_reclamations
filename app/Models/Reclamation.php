<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model 
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'statut',
        'priorite',
        'user_id',
        'categorie_id',
        'assigned_to',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relations
     */

    // Une réclamation appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);  // CORRECTION: belongsTo
    }

    // Une réclamation appartient à une catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);  // CORRECTION: belongsTo
    }

    // Une réclamation peut être assignée à un admin
    public function assignedTo()  // CORRECTION: nom de méthode
    {
        return $this->belongsTo(User::class, 'assigned_to');  // CORRECTION: belongsTo
    }

    // Une réclamation peut avoir plusieurs commentaires
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    // Une réclamation peut avoir plusieurs pièces jointes
    public function piecesJointes()
    {
        return $this->hasMany(PieceJointe::class,'reclamation_id');
    }

    /**
     * Scopes (requêtes réutilisables)
     */

    // Réclamations en attente
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    // Réclamations en cours
    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    // Réclamations résolues
    public function scopeResolues($query)
    {
        return $query->where('statut', 'resolue');
    }

    // Réclamations par priorité
    public function scopePriorite($query, $priorite)
    {
        return $query->where('priorite', $priorite);
    }

    /**
     * Méthodes Helper
     */

    // Vérifier si la réclamation est fermée
    public function isFermee()
    {
        return $this->statut === 'fermee';
    }

    // Vérifier si la réclamation est résolue
    public function isResolue()
    {
        return $this->statut === 'resolue';
    }

    // Obtenir la classe CSS du badge de statut
    public function getStatutBadgeClass()
    {
        return match($this->statut) {
            'en_attente' => 'bg-warning text-dark',
            'en_cours' => 'bg-info text-white',
            'resolue' => 'bg-success text-white',
            'fermee' => 'bg-secondary text-white',
            default => 'bg-secondary',
        };
    }
}   