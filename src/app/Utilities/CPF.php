<?php

namespace App\Utilities;

class CPF
{
    /**
     * Aplicação de máscara
     * @param $cpf
     * @return string
     */
    public static function format($cpf)
    {
        $cpfsplit = str_split($cpf, 3);
        if(strlen($cpf) == 11){
            $cpf = $cpfsplit[0] . '.' . $cpfsplit[1] . '.' . $cpfsplit[2] . '-' . $cpfsplit[3];
        }
        return $cpf;
    }

    /**
     * Remoção de máscara, para inserção no banco de dados
     * @param $cpf
     * @return string
     */
    public static function formatToDatabase(string $cpf) : string
    {
        $cpf = str_replace ('.', '', $cpf);
        $cpf = str_replace ('-', '', $cpf);
        return $cpf;
    }

    /**
     * Verifica se cpf é válido
     * @param $cpf
     * @param bool $masked
     * @return bool
     */
    public static function valid($cpf, bool $masked = true) : bool
    {
        if(strlen($cpf) == 0){
            throw new \InvalidArgumentException('Parâmetro cpf inválido');
        }

        if($masked === false){
            $cpf = self::format($cpf);
        }

        if(!preg_match("/^([0-9]{3}).([0-9]{3}).([0-9]{3})-([0-9]{2})/", $cpf)){
            return false;
        }

        $cpf = str_replace ('.', '', $cpf);
        $cpf = str_replace ('-', '', $cpf);

        if(strlen($cpf) != 11){
            return false;
        }

        $INS_cpf = preg_replace("/[^0-9]/","",$cpf);
        $c = substr($cpf, 0,9);
        $v = substr($cpf, 9,2);
        $d = 0;
        $val = true;
        for($i = 0; $i < 9; $i++){
            $d += $c[$i] * (10 - $i);
        }
        $d == 0 ? $val = false : null;
        $d = (11 - ($d % 11)) > 9 ? 0 : 11 - ($d % 11);
        $v[0] != $d ? $val = false : null;
        $d *= 2;
        for ($i = 0; $i < 9; $i++){
            $d += $c[$i] * (11 - $i);
        }
        $d = (11 - ($d % 11)) > 9 ? 0 : 11 - ($d % 11);
        $v[1] != $d ? $val = false : null;
        preg_match("/0{11}|1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}/", $INS_cpf) ? $val = false : null;
        if(!$val){
            return false;
        }

        return true;
    }
}