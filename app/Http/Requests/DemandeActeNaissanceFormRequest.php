<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class DemandeActeNaissanceFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		return [
            'user_nom' => 'required|string|max:255',
            'user_prenoms' => 'required|string|max:255',
            //'user_date_naissance' => 'required|string|max:255',
            'user_lieu_naissance' => 'required|string|max:255',
            'user_pays_residence' => 'required|string|max:255',
            'user_commune' => 'required|string|max:255',
            'user_quartier' => 'required|string|max:255',
            'user_adresse_postale' => 'required|string|max:255',
            'user_email' => 'required|email',
            'user_telephone' => 'required|string|max:255',
            'titulaire_nom' => 'required|string|max:255',
            'titulaire_prenoms' => 'required|string|max:255',
            'titulaire_date_naissance' => 'required|string|max:255',
            'titulaire_lieu_naissance' => 'required|string|max:255',
            'titulaire_nom_pere' => 'required|string|max:255',
            'titulaire_nom_mere' => 'required|string|max:255',
            'numero_acte_naissance' => 'required|string|max:255',
            'nombre_copies' => 'required|integer|max:255',
            'qualite_demandeur' => 'required|integer|max:255',
            'motif' => 'required|string|max:255',
			
		];
    }
}
