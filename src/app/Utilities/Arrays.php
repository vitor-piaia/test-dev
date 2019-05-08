<?php

namespace App\Utilities;

class Arrays
{
    public static function status(string $key = null)
    {
        $array = [
            'apr' => 'Aprovado',
            'rep' => 'Reprovado',
            'nov' => 'Novo',
        ];

        return array_key_exists($key, $array) ? $array[$key] : (!empty($key) && strlen($key) > 0 ? false : $array);
    }

    public static function statusLabel(string $key = null)
    {
        $array = [
            'nov' => '<span class="badge badge-success">Novo</span>',
            'apv' => '<span class="badge badge-primary">Aprovado</span>',
            'rep' => '<span class="badge badge-danger">Reprovado</span>',
        ];

        return array_key_exists($key, $array) ? $array[$key] : (!empty($key) && strlen($key) > 0 ? false : $array);
    }
}
