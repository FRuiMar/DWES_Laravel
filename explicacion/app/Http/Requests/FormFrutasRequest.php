<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormFrutasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fruta' => 'required|min:5|max:10|in:manzana,peras',
            'descripcion' => 'required|min:10|max:20',
            'pais' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fruta.required' => 'LA FRUTA ES OBLIGATORIA, 5 VECES AL DIA',
            'fruta.min' => 'MAS QUE 5, IDIOTA'
        ];
    }
}
