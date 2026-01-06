<?php
namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;
class CategorieController extends Controller
{

 public function index()
 {
 $categories = Categorie::withCount('reclamations')->paginate(10);
 return view('admin.categories.index', compact('categories'));
 }

 public function create()
 {
 return view('admin.categories.create');
 }

 public function store(Request $request)
 {
 $validated = $request->validate([
 'nom' => 'required|max:255|unique:categories',
 'description' => 'nullable|max:500',
 ]);
 Categorie::create($validated);
 return redirect()
 ->route('categories.index')
 ->with('success', 'Catégorie créée avec succès !');
 }

 public function edit(Categorie $categorie)
 {
 return view('admin.categories.edit', compact('categorie'));
 }

 public function update(Request $request, Categorie $categorie)
 {
 $validated = $request->validate([
 'nom' => 'required|max:255|unique:categories,nom,' . $categorie->id,
 'description' => 'nullable|max:500',
 ]);
 $categorie->update($validated);
 return redirect()
 ->route('categories.index')
 ->with('success', 'Catégorie mise à jour avec succès !');
 }
 
 public function destroy(Categorie $categorie)
 {
 // Vérifier qu'il n'y a pas de réclamations liées
 if ($categorie->reclamations()->count() > 0) {
 return redirect()
 ->back()
 ->with('error', 'Impossible de supprimer cette catégorie car elle contient des réclamations.');
 }
 $categorie->delete();
 return redirect()
 ->route('categories.index')
 ->with('success', 'Catégorie supprimée avec succès !');
 }
}