<?php

namespace App\Utilities;

class Json
{
    /**
     * Conversão do json para array recursivamente
     * @param $object
     * @return array
     */
    public static function toArray($object)
    {
        if(is_object($object)) {
            $object = get_object_vars($object);
        }

        if(is_array($object)) {
            return array_map('self::toArray', $object);
        }

        return $object;
    }

	/**
     * Identa uma string JSON para ser exibida na view
     * @param $string
     * @return $string
     */
    public static function stringFormat($string)
    {
		if(json_decode($string)){
			$json = json_decode($string);
			return json_encode($json, JSON_PRETTY_PRINT);
		}else{
			return $string;
		}

    }

}
