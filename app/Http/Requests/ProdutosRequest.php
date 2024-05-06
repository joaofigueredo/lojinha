<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRequest extends FormRequest
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
            'nome' => ['required', 'min:2'],
            'preco' => ['required', 'numeric'],
            'descricao' =>['required', 'string'],
            'cover' =>  ['required', 'image'] ,           
        ];
    }

    public function messages()
    {
        return[
            'nome.required' => 'nome é obrigatório!',
            'nome.min' => 'nome precisa de 2 ou mais caracteres!',
            'preco.required' => 'Preço é obrigatório!',
            'preco.numeric' => 'Preço é um número válido!',
            'descricao.required' => 'descrição é obrigatório!',
            'descricao.string' => 'descrição precisa ser um texto!',
            'cover.required' => 'imagem é obrigatória',
            'cover.image' => 'Imagem invalida!'
        ];

    }
}
