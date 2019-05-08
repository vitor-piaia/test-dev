<?php

namespace App\Utilities;

class Phone
{
    /**
     * Verifica se string é celular
     * @param string $value
     * @return bool
     */
    public static function isCell(string $value) : bool
    {
        if (strlen($value) <= 2) {
            return false;
        }
        list($ddd, $celular) = explode(' ', $value);
        $celular = str_replace('-', '', $celular);

        $numeroAnterior = $celular[0];
        $valido = 'nao'; //se celular é válido
        $tamanhoCelular = strlen($celular);
        for ($i = 0; $i < $tamanhoCelular; $i++) { //loop para verificar se todos caracteres iguais
            if ($numeroAnterior != $celular[$i]) { //se algum dígito for diferente o celular é valido
                $valido = 'sim';
                break;
            }

            $numeroAnterior = $celular[$i];
        }

        if (strlen($celular) != 9) {
            $valido = 'nao';
        }

        if ($valido == 'nao') { //todos dígitos iguais
            return false;
        }

        if (strlen($celular) == 9) { //se possui nono dígito
            return $celular[0] == 9; //se nono dígito for 9 então é celular
        }

        $celularValido = array(9, 8, 7, 6);
        return in_array($celular[0], $celularValido);
    }

    /**
     * Verifica se string é telefone
     * @param string $value
     * @return bool
     */
    public static function isPhone(string $value) : bool
    {
        $regex = strlen($value) == 12 ? "/^[0-9]{2} [0-9]{4}-[0-9]{4}$/" : "/^[0-9]{4}-[0-9]{4}$/";
        return preg_match($regex, $value);
    }

    /**
     * Remoção de máscara de telefone
     * @param string $phone
     * @return mixed|string
     */
    public static function removeMask(string $phone)
    {
        $phone = str_replace(' ', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace('-', '', $phone);
        return $phone;
    }

    /**
     * Aplica mascara em telefones.
     *
     * @param $number
     * @return string
     */
    public static function telephone($number)
    {
        if ($number == null) {
            return '';
        }
        $number="".substr($number, 0, 2)." ".substr($number, 2, -4)."-".substr($number, -4);
        return $number;
    }
}
