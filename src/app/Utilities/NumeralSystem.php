<?php

namespace App\Utilities;

class NumeralSystem
{
    /**
     * Converts to hexadecimal format
     * @param $value
     * @return string
     */
    public static function bin2hex($value) : string
    {
        return bin2hex($value);
    }

    /**
     * Converts to binary format
     * @param $value
     * @return string
     */
    public static function hex2bin($value) : string
    {
        $out = '';
        for($c = 0; $c < mb_strlen($value); $c += 2){
            $out .= chr(hexdec($value[$c] . $value[$c+1]));
        }
        return (string) $out;
    }
}