<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'            => 'required|string',
            'product_image'   => 'image|file|max:2048',
            'category_id'     => 'required|integer',
            'consecutive'     => 'required|string',
            'lands_id'        => 'required|integer',
            'varietie_id'     => 'required|integer',
            'type_branche_id' => 'required|integer',
            'table_id'        => 'required|integer',
            'grades_id'       => 'required|integer',
            'quantity'        => 'nullable|numeric',
            'notes'           => 'nullable|max:1000'
        ];
    }

    // protected function prepareForValidation(): void
    // {
    //     $this->merge([
    //         'slug' => Str::slug($this->name, '-'),
    //         'code' =>
    //     ]);
    // }
}
