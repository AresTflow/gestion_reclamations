<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use App\Models\Categorie;
use App\Http\Requests\StoreReclamationRequest;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    /**
     * Afficher la liste des réclamations de l'utilisateur
     */
    public function index()
    {
        $reclamations = auth()->user()
            ->reclamations()
            ->with('categorie')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Log pour déboguer l'index
        \Log::info('📋 INDEX - Résultats', [
            'total' => $reclamations->total(),
            'count' => $reclamations->count(),
            'current_page' => $reclamations->currentPage(),
            'ids' => $reclamations->pluck('id')->toArray()
        ]);

        return view('reclamations.index', compact('reclamations'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('reclamations.create', compact('categories'));
    }

    /**
     * Enregistrer une nouvelle réclamation
     */
    public function store(StoreReclamationRequest $request)
    {
        \Log::info(' STORE - Début', [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'titre' => $request->titre
        ]);

        // Créer la réclamation
        $reclamation = auth()->user()->reclamations()->create([
            'titre' => $request->titre,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'priorite' => $request->priorite,
            'statut' => 'en_attente',
        ]);

        \Log::info(' STORE - Réclamation créée', [
            'id' => $reclamation->id,
            'titre' => $reclamation->titre,
            'created_at' => $reclamation->created_at,
            'user_id' => $reclamation->user_id
        ]);

        // Gérer les pièces jointes
        if ($request->hasFile('pieces_jointes')) {
            foreach ($request->file('pieces_jointes') as $file) {
                $path = $file->store('reclamations', 'public');

                $reclamation->piecesJointes()->create([
                    'nom_fichier' => $file->getClientOriginalName(),
                    'chemin' => $path,
                ]);
            }
        }

        return redirect()
            ->route('reclamations.index')
            ->with('success', 'Réclamation créée avec succès !');
    }

    /**
     * Afficher les détails d'une réclamation
     */
    public function show(Reclamation $reclamation)
    {
        // Vérifier que l'utilisateur peut voir cette réclamation
        $this->authorize('view', $reclamation);

        // Charger les relations
        $reclamation->load([
            'categorie',
            'commentaires.user',
            'piecesJointes', // IMPORTANT: au pluriel pour correspondre à la table 'pieces_jointes'
            'assignedTo'
        ]);

        // Log pour déboguer le show
        \Log::info('👁️ SHOW - Réclamation', [
            'id' => $reclamation->id,
            'titre' => $reclamation->titre,
            'pieces_jointes_count' => $reclamation->piecesJointes->count(),
            'user_id' => $reclamation->user_id
        ]);

        return view('reclamations.show', compact('reclamation'));
    }
}