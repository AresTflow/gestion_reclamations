<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PieceJointe extends Model
{
    use HasFactory;
     protected $table = 'pieces_jointes';

    protected $fillable = [
        'nom_fichier',      // ✅ CORRIGÉ (était 'piece_jointes')
        'chemin',
        'reclamation_id',
    ];

    /**
     * Relation : Une pièce jointe appartient à une réclamation
     */
    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class);  // ✅ CORRIGÉ (était belongsToo)
    }

    /**
     * Accesseur : Obtenir l'URL complète du fichier
     */
    public function getUrlAttribute()
    {
        return Storage::url($this->chemin);
    }

    /**
     * Accesseur : Obtenir l'extension du fichier
     */
    public function getExtensionAttribute()
    {
        return pathinfo($this->nom_fichier, PATHINFO_EXTENSION);  // ✅ CORRIGÉ (était THINFO_EXTENSION)
    }

    /**
     * Accesseur : Obtenir l'icône selon le type de fichier
     */
    public function getIconeAttribute()
    {
        $extension = $this->extension;
        
        return match($extension) {
            'pdf' => 'bi-file-pdf',
            'doc', 'docx' => 'bi-file-word',
            'jpg', 'jpeg', 'png' => 'bi-file-image',
            default => 'bi-file-earmark',
        };
    }
}