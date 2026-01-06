<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Reclamation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateReclamationRequest;
class ReclamationController extends Controller
{
 /**
 * * Af Afficher toutes les réclamations avec filtres ficher toutes les réclamations avec filtres
 */
 public function index(Request $request)
 {
 $query = Reclamation::with(['user', 'categorie', 'assignedTo']);
 // Filtr // Filtre par statut e par statut
 if ($request->filled('statut')) {
 $query->where('statut', $request->statut);
 }
 // Filtr // Filtre par priorité e par priorité
 if ($request->filled('priorite')) {
 $query->where('priorite', $request->priorite);
 }
 // Recher // Recherche textuelle che textuelle
 if ($request->filled('search')) {
 $search = $request->search;
 $query->where(function($q) use ($search) {
 $q->where('titre', 'like', "%{$search}%")
 ->orWhere('description', 'like', "%{$search}%");
 });
 }
 $reclamations = $query->latest()->paginate(15);
 // Statistiques
 $stats = [
 'total' => Reclamation::count(),
 'en_attente' => Reclamation::where('statut', 'en_attente')->count(),
 'en_cours' => Reclamation::where('statut', 'en_cours')->count(),
 'resolues' => Reclamation::where('statut', 'resolue')->count(),
 ];
 return view('admin.reclamations.index', compact('reclamations', 'stats'));
 }
 /**
 * * Af Afficher les détails d'une réclamation ficher les détails d'une réclamation
 */
 public function show(Reclamation $reclamation)
 {
 $reclamation->load([
 'user',
 'categorie',
 'commentaires.user',
 'piecesJointes',
 'assignedTo'
 ]);
 $admins = User::where('role', 'admin')->get();
 return view('admin.reclamations.show', compact('reclamation', 'admins'));
 }
 /**
 * Mettre à jour une réclamation
 */
 public function update(UpdateReclamationRequest $request, Reclamation $reclamation)
{
    // Les données sont déjà validées automatiquement
    $validated = $request->validated();
    
    $reclamation->update($validated);
    
    return redirect()
        ->back()
        ->with('success', 'Réclamation mise à jour avec succès !');
}
}