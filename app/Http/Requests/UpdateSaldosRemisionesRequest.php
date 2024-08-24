<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaldosRemisionesRequest extends FormRequest
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
            'remision_id'         => 'required|integer',
            'produccion_freedom'  => 'required|integer',
            'produccion_color'    => 'required|integer',
            'devolucion_freedom'  => 'required|integer',
            'devolucion_color'    => 'required|integer',
            'valor_freedom'       => 'required|integer',
            'valor_color'         => 'required|integer',
            'valor_pagar_freedom' => 'required|integer',
            'valor_pagar_color'   => 'required|integer',
            
        ];
    }
}
