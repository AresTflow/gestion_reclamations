<?php
namespace App\Providers;
use App\Models\Reclamation;
use App\Policies\ReclamationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
 /**
 * Mapping des policies
 */
 protected $policies = [
 Reclamation::class => ReclamationPolicy::class,
 ];
 /**
 * Enregistrer les services d'authentification
 */
 public function boot()
 {
 $this->registerPolicies();
 }
}