<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Reclamation;
use App\Models\Commentaire;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReclamationSeeder extends Seeder
{
    /**
     * Exécuter les seeds de réclamations.
     */
    public function run(): void
    {
        // Récupérer les utilisateurs et catégories
        $users = User::where('role', 'user')->get();
        $admins = User::where('role', 'admin')->get();
        $categories = Categorie::all();

        // Données de réclamations de test
        $reclamationsData = [
            [
                'titre' => 'Facture incorrecte pour le mois de décembre',
                'description' => 'J\'ai reçu une facture de 250€ alors que ma consommation habituelle est de 180€. Il y a visiblement une erreur dans le calcul.',
                'statut' => 'en_attente',
                'priorite' => 'haute'
            ],
            [
                'titre' => 'Problème de connexion à mon compte',
                'description' => 'Impossible de me connecter à mon espace client depuis 3 jours. Le mot deppe semble être réinitialisé automatiquement.',
                'statut' => 'en_cours',
                'priorite' => 'haute'
            ],
            [
                'titre' => 'Produit défectueux - Casque audio',
                'description' => 'Le casque audio commandé la semaine dernière ne fonctionne que d\'un côté. Le son du canal droit est complètement absent.',
                'statut' => 'resolue',
                'priorite' => 'moyenne'
            ],
            [
                'titre' => 'Livraison en retard de 5 jours',
                'description' => 'Ma commande #45678 devait être livrée le 15 décembre. Nous sommes le 20 et je n\'ai toujours pas reçu le colis.',
                'statut' => 'en_cours',
                'priorite' => 'moyenne'
            ],
            [
                'titre' => 'Demande de remboursement non traitée',
                'description' => 'J\'ai demandé un remboursement il y a 2 semaines pour un produit retourné. Aucune nouvelle depuis, ni confirmation ni virement.',
                'statut' => 'en_attente',
                'priorite' => 'haute'
            ],
            [
                'titre' => 'Service client injoignable',
                'description' => 'J\'essaye de contacter le service client depuis une semaine. Le téléphone sonne dans le vide et les mails restent sans réponse.',
                'statut' => 'en_attente',
                'priorite' => 'moyenne'
            ],
            [
                'titre' => 'Erreur dans mes informations personnelles',
                'description' => 'Mon adresse postale est incorrecte dans mon profil. J\'ai essayé de la modifier mais les changements ne sont pas sauvegardés.',
                'statut' => 'resolue',
                'priorite' => 'basse'
            ],
            [
                'titre' => 'Abonnement résilié par erreur',
                'description' => 'Mon abonnement premium a été résilié automatiquement alors que mon paiement a bien été effectué.',
                'statut' => 'en_cours',
                'priorite' => 'haute'
            ]
        ];

        // Créer les réclamations
        foreach ($reclamationsData as $data) {
            $reclamation = Reclamation::create([
                'titre' => $data['titre'],
                'description' => $data['description'],
                'statut' => $data['statut'],
                'priorite' => $data['priorite'],
                'user_id' => $users->random()->id,
                'categorie_id' => $categories->random()->id,
                'assigned_to' => $data['statut'] !== 'en_attente' ? $admins->random()->id : null,
                'created_at' => Carbon::now()->subDays(rand(1, 30))
            ]);

            // Ajouter des commentaires pour les réclamations en cours/résolues
            if (in_array($data['statut'], ['en_cours', 'resolue'])) {
                Commentaire::create([
                    'contenu' => 'Bonjour, nous avons bien reçu votre réclamation. Notre équipe examine actuellement votre dossier.',
                    'reclamation_id' => $reclamation->id,
                    'user_id' => $admins->random()->id,
                    'created_at' => $reclamation->created_at->addHours(rand(1, 24))
                ]);

                if ($data['statut'] === 'resolue') {
                    Commentaire::create([
                        'contenu' => 'Votre problème a été résolu. Nous vous avons envoyé un email de confirmation avec les détails.',
                        'reclamation_id' => $reclamation->id,
                        'user_id' => $admins->random()->id,
                        'created_at' => $reclamation->created_at->addDays(rand(2, 5))
                    ]);
                }
            }
        }

        $this->command->info('✅ ' . count($reclamationsData) . ' réclamations créées avec succès !');
    }
}