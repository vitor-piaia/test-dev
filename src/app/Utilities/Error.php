<?php

namespace App\Utilities;

class Error
{
    /**
     * Mensagens de erro default do sistema
     * @return array
     */
    public static function defaultMessages()
    {
        return [
            'required'                       => ':attribute é obrigatório',
            'required_if'                    => ':attribute é obrigatório',
            'required_with'                  => ':attribute é obrigatório',
            'required_without'               => ':attribute é obrigatório',
            'required_without_all'           => ':attribute é obrigatório',
            'array'                          => ':attribute deve ser um array',
            'cpf'                            => ':attribute inválido',
            'cnpj'                           => ':attribute inválido',
            'cep'                            => ':attribute inválido',
            'email'                          => ':attribute deve conter um e-mail válido',
            'max'                            => ':attribute deve conter no máximo :max caracteres',
            'min'                            => ':attribute deve conter no mínimo :min caracteres',
            'in'                             => ':attribute inválido',
            'url'                            => ':attribute deve ser uma url válida',
            'file'                           => ':attribute deve ser um arquivo',
            'unique'                         => ':attribute já existente na base de dados',
            'exists'                         => ':attribute inválido',
            'integer'                        => ':attribute deve conter um número inteiro',
            'numeric'                        => ':attribute deve conter um número',
            'money'                          => ':attribute deve estar em formato de moeda (R$)',
            'percentage'                     => ':attribute deve estar em formato de percentagem (%)',
            'mimes'                          => 'somente são permitidas as extensões :values',
            'distinct'                       => ':attribute duplicado',
            'confirmed'                      => 'As senhas devem ser iguais',
            'cell'                           => ':attribute deve ser um celular válido',
            'phone'                          => ':attribute deve ser um telefone válido',
            'phone_cell'                     => ':attribute deve ser um telefone ou celular válido',
            'credit_card'                    => ':attribute inválido',
            'digits'                         => ':attribute deve conter :digits caracteres',
            'digits_between'                 => ':attribute deve conter entre :min e :max caracteres',
            'between'                        => ':attribute deve conter entre :min e :max caracteres',
            'date'                           => ':attribute deve conter uma data válida',
            'date_format'                    => ':attribute deve conter uma data válida',
            'before'                         => ':attribute deve conter uma data anterior à :date.',
            'after'                          => ':attribute deve conter uma data maior que a de início',
            'after_or_equal'                 => ':attribute deve conter uma data maior ou igual a de início',
            'date_before_today'              => ':attribute deve conter uma data menor que a data de hoje',
            'date_before_equals_today'       => ':attribute deve conter uma data menor ou igual a data de hoje',
            'password'                       => ':attribute deve conter ao menos uma letra minúscula, uma maiúscula, número e um caracter especial',
            'recaptcha'                      => ':attribute deve ser marcado',
            'small_letter'                   => ':attribute deve conter somente letras minúsculas e sem espaços'
        ];
    }
}