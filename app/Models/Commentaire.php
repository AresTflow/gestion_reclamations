<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    /**
     * Attributs assignables en masse
     */
    protected $fillable = [
        'contenu',
        'reclamation_id',
        'user_id',
    ];

    /**
     * Attributs à caster
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Relations
     */
    
    // Un commentaire appartient à une réclamation
    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class);  // CORRECTION ICI
    }
    
    // Un commentaire appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);  // CORRECTION ICI
    }

    /**
     * Méthodes Helper
     */
    
    // Vérifier si le commentaire vient d'un admin
    public function isFromAdmin()
    {
        return $this->user->isAdmin();
    }
}