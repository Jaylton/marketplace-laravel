<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|min:10',
            'body' => 'required|min:30',
            'price' => 'required',
            'categories' => 'required',
            'photos.*' => 'image',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'min' => ' O tamanho mínino é :min caracteres',
            'image' => ' O arquivo não é uma imagem',
        ];
    }
}
