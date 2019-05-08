<?php

namespace App\Utilities;

class Mask
{
    /**
     * Aplica uma máscara qualquer em um valor.
     *
     * Ex: Mask::apply(00000000191, '###.###.###-##')
     *     Imprime: 000.000.001-91
     *
     * @param $value
     * @param string $mask
     * @return string
     */
    public static function apply($value, string $mask)
    {
        $value = trim($value);
        if(strlen($value) == 0){
            return null;
        }

        if(strlen($mask) == 0){
            return $value;
        }

        $maskared = '';

        $k = 0;
        $lenght = strlen($mask) - 1;

        for ($i = 0; $i <= $lenght; $i++) {
            if ($mask[$i] == '#') {
                if (isset($value[$k])) {
                    $maskared .= $value[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }
}