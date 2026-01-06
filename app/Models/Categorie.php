<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Categorie extends Model
{
 use HasFactory;
 protected $fillable = [
 'nom',
 'description',
 ];
 // Une catégorie peut avoir plusieurs réclamations
 public function reclamations()
 {
 return $this->hasMany(Reclamation::class);
 }
 // Compter le nombr // Compter le nombre de réclamations dans cette catégorie e de réclamations dans cette catégorie
 public function getNombreReclamationsAttribute()
 {
 return $this->reclamations()->count();
 }
}