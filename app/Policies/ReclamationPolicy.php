<?php
namespace App\Policies;
use App\Models\Reclamation;
use App\Models\User;
class ReclamationPolicy
{
 /**
 * Déterminer si l'utilisateur peut voir la réclamation
 */
 public function view(User $user, Reclamation $reclamation)
 {
 // // Admin peut tout voir Admin peut tout voir, utilisateur seulement ses réclamations , utilisateur seulement ses réclamations
 return $user->isAdmin() || $user->id === $reclamation->user_id;
 }
 /**
 * Déterminer si l'utilisateur peut mettre à jour la réclamation
 */
 public function update(User $user, Reclamation $reclamation)
 {
 // Seul un admin peut modifier
 return $user->isAdmin();
 }
 /**
 * Déterminer si l'utilisateur peut supprimer la réclamation
 */
 public function delete(User $user, Reclamation $reclamation)
 {
 // Seul un admin peut supprimer
 return $user->isAdmin();
 }
 /**
 * Déterminer si l'utilisateur peut ajouter un commentaire
 */
 public function addComment(User $user, Reclamation $reclamation)
 {
 // // Admin ou pr Admin ou propriétair opriétaire peut commenter e peut commenter
 return $user->isAdmin() || $user->id === $reclamation->user_id;

 }
}