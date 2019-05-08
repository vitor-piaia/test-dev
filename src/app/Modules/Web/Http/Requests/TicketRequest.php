<?php

namespace App\Modules\Web\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
        $rules = [
            'nome'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'numpedido' => 'required|integer',
            'titulo'    => 'required|max:150',
            'descricao' => 'required|max:255'
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'nome'      => 'nome do cliente',
            'email'     => 'e-mail',
            'numpedido' => 'nº do pedido',
            'titulo'    => 'titulo',
            'descricao' => 'conteudo do ticket'
        ];
    }
}