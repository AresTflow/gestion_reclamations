<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReclamationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'statut' => 'required|in:en_attente,en_cours,resolue,fermee',
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut doit être : en attente, en cours, résolue ou fermée.',
            'assigned_to.exists' => 'L\'administrateur sélectionné n\'existe pas.',
        ];
    }
}