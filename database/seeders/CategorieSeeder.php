<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Exécuter les seeds de catégories.
     */
    public function run(): void
    {
        $categories = [
            [
                'nom' => 'Facturation',
                'description' => 'Problèmes liés aux factures, paiements, erreurs de tarification'
            ],
            [
                'nom' => 'Service Client',
                'description' => 'Questions concernant le service client et le support'
            ],
            [
                'nom' => 'Produit/Service',
                'description' => 'Défauts techniques, problèmes qualité, fonctionnalités manquantes'
            ],
            [
                'nom' => 'Livraison',
                'description' => 'Retards de livraison, colis endommagés, problèmes d\'expédition'
            ],
            [
                'nom' => 'Remboursement',
                'description' => 'Demandes de remboursement, retours de produits'
            ],
            [
                'nom' => 'Autre',
                'description' => 'Autres types de réclamations non catégorisées'
            ]
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }

        $this->command->info('✅ 6 catégories créées avec succès !');
    }
}