<?php

namespace App\Utilities;

class Status
{
    /** const SUCCESS constante responsável pela resposta de Sucesso nas requisições */
    const SUCCESS = '00';

    /** const UNAUTHORIZED constante responsável pela resposta de Inautorizado nas requisições */
    const ERROR = '01';

    /** const ERROR_VALIDATION constante responsável pela resposta de Erro nas Validações das requisições */
    const ERROR_VALIDATION = '02';

    /** const API_SUCCESS constante responsável pela resposta de Sucesso nas requisições */
    const API_SUCCESS = '200';

    /** const ERROR_VALIDATION constante responsável pela resposta de Erro nas Validações das requisições */
    const API_ERROR_VALIDATION = '400';

    /** const UNAUTHORIZED constante responsável pela resposta de Inautorizado nas requisições */
    const UNAUTHORIZED = '401';

    /** const NOT_FOUND constante responsável pela resposta de Inexistente nas requisições */
    const NOT_FOUND = '404';

    /** const INTERNAL_ERROR constante responsável pela resposta de Erro Interno das requisições */
    const INTERNAL_ERROR = '500';

    /**
     * Get current status related label
     *
     * @param $status
     * @return mixed
     */
    public static function statusLabel($status)
    {
        $array = [
            'ati' => '<span class="badge badge-primary">Ativo</span>',
            'ina' => '<span class="badge badge-danger">Inativo</span>',
        ];

        foreach ($array as $key => $value) {
            if ($status == $key) {
                return $value;
            }
        }
    }

    /**
     * Get all available status
     *
     * @return array
     */
    public static function statusValidation()
    {
        $array = ['ati', 'ina'];

        return $array;
    }

    /**
     * Get all available status
     *
     * @return array
     */
    public static function status()
    {
        $array = [
            'ati' => 'Ativo',
            'ina' => 'Inativo'
        ];

        return $array;
    }

    /**
     * Get all available status
     *
     * @param $status
     * @return bool|mixed
     */
    public static function statuses($status)
    {
        $array = [
            'ati' => 'Ativo',
            'ina' => 'Inativo'
        ];

        return $array[$status] ?? false;
    }
}
