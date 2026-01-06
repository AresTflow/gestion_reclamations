<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Ajouter un commentaire à une réclamation
     */
    public function store(Request $request, Reclamation $reclamation)
    {
        // Vérifier que l'utilisateur peut commenter
        $this->authorize('view', $reclamation);
        
        // Valider les données AVEC MESSAGES PERSONNALISÉS
        $validated = $request->validate([
            'contenu' => 'required|min:3|max:1000',
        ], [
            'contenu.required' => 'Le commentaire ne peut pas être vide.',
            'contenu.min' => 'Le commentaire doit contenir au moins 3 caractères.',
            'contenu.max' => 'Le commentaire ne peut pas dépasser 1000 caractères.',
        ]);
        
        // Créer le commentaire
        $reclamation->commentaires()->create([
            'contenu' => $validated['contenu'],
            'user_id' => auth()->id(),
        ]);
        
        return redirect()
            ->route('reclamations.show', $reclamation)
            ->with('success', 'Commentaire ajouté avec succès !');
    }
}