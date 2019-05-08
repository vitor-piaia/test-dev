<?php

namespace App\Utilities;

use \Illuminate\Support\Str as LaravelString;

class Str extends LaravelString
{
    /**
     * Remoção da string de tudo que não seja alfanumérico e hífen
     * @param string $value
     * @return mixed
     */
    public static function accentRemove(string $value) : string
    {
        $value = preg_replace('/[^A-Za-z0-9\-]/', '', $value); // Removes special chars.
        return preg_replace('/-+/', '-', $value); // Replaces multiple hyphens with single one.
    }

    /**
     * Substituição de acentos por equivalente sem acento
     * @param string $value
     * @return string
     */
    public static function accentReplace(string $value) : string
    {
        $replace = [
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
        ];

        return preg_replace(array_keys($replace), array_values($replace), $value);
    }

    /**
     * conversão de string para permalink
     * @param string $value
     * @return string
     */
    public static function toPermalink(string $value) : string
    {
        $value = strtolower(self::accentReplace($value));

        // remove tudo que não seja letra, número ou espaço
        $value = preg_replace('/[^a-zA-Z0-9 _\-]/', '', $value);
        return preg_replace(array('/[ _]+/'), '-', trim($value));
    }

    /**
     * Concatena uma string em outra, porém mantendo um tamanho fixo.
     *  Para manter o tamanho fixo, o parâmetro $string tem caracteres removidos.
     * @param string $string string original
     * @param string $append string que será acrescentada
     * @param int $length tamanho desejado para a string resultante
     * @return string
     */
    public static function endAppend(string $string, string $append, int $length)
    {
        $appendLength = strlen($append);
        $string = substr($string, 0, ($length - $appendLength));
        return "{$string}{$append}";
	}

	/**
     * Trunca uma string para um tamanho fixo.
     *  Caso o tamanho da string seja menor do que $length, a string original é retornada
     * @param string $string string original
     * @param int $length tamanho desejado para a string resultante
     * @return string
     */
	public static function truncate(string $string, int $length)
	{
		if(strlen($string) <= $length) {
			return $string;
		}
		$string = substr($string, 0, ($length - 3));
		return "{$string}...";
	}

    /**
     * Formata o nome de um arquivo para um formato válido, removendo caracteres que não poderão ser interpretados
     * @param string $fileName
     * @return mixed
     */
    public static function formatFileName(string $fileName)
    {
        $alphaNum = 'a-zA-Z0-9';
        $accent = 'ÀÁÅÃÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ';
        $special = '\/\.\,\-\_\{\}\[\]\:\(\)\$\#\!\&\*\+\=%_@';
        $pattern = "/[^{$alphaNum}{$accent}{$special}]/";

        return preg_replace($pattern, '', $fileName);
    }
}