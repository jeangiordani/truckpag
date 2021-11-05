<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAddressRequest extends FormRequest
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
            'logradouro' => 'required|string',
            'numero' => 'required|string',
            'bairro' => 'required|string',
            'city_id' => 'required|exists:cities,id',
        ];
    }

    public function messages()
    {
        return [
            'logradouro.required' => 'O campo logradouro é obrigatório',
            'numero.required' => 'O campo numero é obrigatório',
            'bairro.required' => 'O campo bairro é obrigatório',
            'city_id.required' => 'O campo city_id é obrigatório',
            'logradouro.string' => 'O campo logradouro deve ser do tipo string',
            'numero.string' => 'O campo numero deve ser do tipo string',
            'bairro.string' => 'O campo bairro deve ser do tipo string',
            'city_id.exists' => 'Cidade não encontrada',
        ];
    }
}
