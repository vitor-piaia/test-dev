<?php

namespace App\Validator;

class Phone
{
    public function phone($field, $value, $attribute)
    {
        if(empty($value)){
            return true;
        }
        return \App\Utilities\Phone::isPhone($value);
    }

    public function cell($field, $value, $attribute)
    {
        if(empty($value)){
            return true;
        }
        return \App\Utilities\Phone::isCell($value);
    }

    public function phoneCell($field, $value, $attribute)
    {
        if(empty($value)){
            return true;
        }
        return \App\Utilities\Phone::isPhone($value) || \App\Utilities\Phone::isCell($value);
    }
}