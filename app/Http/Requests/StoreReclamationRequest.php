<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReclamationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titre' => 'required|string|min:10|max:255',
            'description' => 'required|string|min:20|max:2000',
            'categorie_id' => 'required|exists:categories,id',
            'priorite' => 'required|in:basse,moyenne,haute',
            'pieces_jointes' => 'nullable|array|max:5',
            'pieces_jointes.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'titre.min' => 'Le titre doit faire au moins 10 caractères.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit faire au moins 20 caractères.',
            'description.max' => 'La description ne doit pas dépasser 2000 caractères.',
            'categorie_id.required' => 'La catégorie est obligatoire.',
            'categorie_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'priorite.required' => 'La priorité est obligatoire.',
            'priorite.in' => 'La priorité doit être basse, moyenne ou haute.',
            'pieces_jointes.max' => 'Vous ne pouvez joindre que 5 fichiers maximum.',
            'pieces_jointes.*.mimes' => 'Seuls les fichiers PDF, JPG, PNG, DOC, DOCX sont autorisés.',
            'pieces_jointes.*.max' => 'Chaque fichier ne doit pas dépasser 2MB.',
        ];
    }
}