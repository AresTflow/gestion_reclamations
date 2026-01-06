<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable ;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens ;
class User extends Authenticatable
{
 use  HasApiTokens, HasFactory, Notifiable;

 protected $fillable = [
 'name',
 'email',
 'password',
 'role',
 ];

 protected $hidden = [
 'password',
 'remember_token',
 ];

 protected $casts = [
 'email_verified_at' => 'datetime',
 'password' => 'hashed',
 ];
 
 public function reclamations()
 {
 return $this->hasMany(Reclamation::class);
 }
 // peut avoir plusieurs commentair //peut avoir plusieurs commentaireses
 public function commentaires()
 {
 return $this->hasMany(Commentaire::class);
 }
 // Un admin peut avoir des réclamations assignées
 public function reclamationsAssignees()
 {
 return $this->hasMany(Reclamation::class, 'assigned_to');
 }
 
 // Vérifier si l'utilisateur est administrateur
 public function isAdmin()
 {
 return $this->role === 'admin';
 }
 // Vérifier si c'est un utilisateur simple
 public function isUser()
 {
 return $this->role === 'user';
 }
}