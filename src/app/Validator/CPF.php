<?php

namespace App\Validator;

class CPF
{
    public function apply($field, $value, $attribute)
    {
        if(empty($value)){
            return true;
        }
        return \App\Utilities\CPF::valid($value);
    }
}