<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reclamation;
use App\Models\User; // Ajout de l'import du modèle User
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    /**
     * Afficher le dashboard administrateur
     */
    public function index()
    {
        // Statistiques (cachées pour 5 minutes)
        $stats = Cache::remember('admin_stats', 300, function () {
            return [
                'total' => Reclamation::count(),
                'en_attente' => Reclamation::where('statut', 'en_attente')->count(),
                'en_cours' => Reclamation::where('statut', 'en_cours')->count(),
                'resolues' => Reclamation::where('statut', 'resolue')->count(),
                'fermees' => Reclamation::where('statut', 'fermee')->count(),
                'priorite_haute' => Reclamation::where('priorite', 'haute')->count(),
                'priorite_moyenne' => Reclamation::where('priorite', 'moyenne')->count(),
                'priorite_basse' => Reclamation::where('priorite', 'basse')->count(),
                'total_users' => User::count(), // Utilisation du modèle User importé
            ];
        });

        // Réclamations récentes
        $recentReclamations = Reclamation::with(['user', 'categorie'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentReclamations'));
    }
}