<?php

namespace App\Utilities;

class XSS
{
    /** @var string ALPHANUMERIC constant para identificar alfanumerico */
    const ALPHANUMERIC = 'alpha_numeric';

    /** @var string ACCENT constant para identificar acento */
    const ACCENT = 'accent';

    /** @var string SPECIAL constant para identificar caracteres especiais */
    const SPECIAL = 'special';

    /** @var string METACHARACTER constant para identificar meta caracteres */
    const METACHARACTER = 'meta';

    /** @var string HTML constant para identificar htmls */
    const HTML = 'html';

    /**
     * Efetua a filtragem da string com os parâmetros especificados
     * @param string $value valor a ser filtrado
     * @param mixed $options string ou array com opções para efetuar o filtro
     * @return string
     */
    public static function filter(string $value, $options) : string
    {
        if(!is_array($options)){
            $options = [$options];
        }

        if(!in_array(XSS::HTML, $options)){
            $value = strip_tags($value);
        }

        if(!self::isValidOptions($options)){
            return $value;
        }

        return preg_replace(self::buildPattern($options), '', $value);
    }

    /**
     * Valida as opções de filtragem
     * @param array $options
     * @return bool
     */
    private static function isValidOptions(array $options) : bool
    {
        $array = [self::METACHARACTER, self::ACCENT, self::SPECIAL, self::METACHARACTER, self::HTML];
        foreach($options as $option){
            if(in_array($option, $array)){
                return true;
            }
        }

        return false;
    }

    /**
     * Cria a expressão regular com base nos padrões
     * @param $options
     * @return string
     */
    private static function buildPattern(array $options) : string
    {
        $pattern = '';

        if(in_array(self::HTML, $options)){
            $pattern .= self::html();
        }

        if(in_array(self::ALPHANUMERIC, $options)){
            $pattern .= self::alphaNumericRegex();
        }

        if(in_array(self::ACCENT, $options)){
            $pattern .= self::accentRegex();
        }

        if(in_array(self::SPECIAL, $options)){
            $pattern .= self::specialRegex();
        }

        if(in_array(self::METACHARACTER, $options)){
            $pattern .= self::metaCharacter();
        }

        return "/[^{$pattern}]/";
    }

    /**
     * Regex para string alfanumérica
     * @return string
     */
    private static function alphaNumericRegex() : string
    {
        return 'a-zA-Z0-9';
    }

    /**
     * Regex para string com acento
     * @return string
     */
    private static function accentRegex() : string
    {
        return 'ÀÁÅÃÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ';
    }

    /**
     * Regex para caracteres especiais
     * Contempla:
     *      / (barra), .(ponto), ,(vírgula), -(hífen), {}(chaves), [](colchetes), ()(parênteses), :(dois pontos),
     *      _(underline), @(arroba), $(cifrão), #(sustenido), !(exclamação), &(e comercial), %(porcentagem)
     *      * (asterísco), +(mais), =(igual), "(aspas), ;(ponto e vírgula)
     * @return string
     */
    private static function specialRegex() : string
    {
        return '\/\.\,\-\{\}\[\]\:\(\)\$\#\!¹²³£¢¬\&\*\+\=\"\;%_@';
    }

    /**
     * Regex para meta caracteres
     * Contempla: Espaço
     * @return string
     */
    private static function metaCharacter() : string
    {
        return '\s';
    }

    /**
     * Regex para HTML
     * Contempla: Tags HTML
     * @return string
     */
    private static function html() : string
    {
        return '<(.|\n)*?>';
    }
}