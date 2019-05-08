<?php

function encrypt_url($value)
{
    return \App\Crypt\Crypt::encrypt($value);
}

function decrypt_url($value)
{
    if(strlen($value) == 0){
        return $value;
    }

    return \App\Crypt\Crypt::decrypt($value)['value'];
}