<?php

namespace App\Utilities;

class Utils
{
    /**
     * Consulta das informações do usuário logado chavendo por módulo
     * @return array
     */
    public static function currentUser() : array
    {
        $user = auth()->user();

        $array = ['id' => null];
        if(empty($user)){
            return $array;
        }

        $array['id'] = $user->idadmusu ?? $user->idempusu;
        return $array;
    }
}