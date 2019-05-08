<?php

namespace App\Crypt;

use App\Utilities\NumeralSystem;
use App\Utilities\Str;
use Illuminate\Support\Facades\Crypt as ICrypt;
use Illuminate\Support\Facades\Session;

class Crypt
{
    /**
     * Encrypts a value
     *
     * @param $value
     * @return string
     */
    public static function encrypt(string $value) : string
    {
        if (self::getConfig() === true) {
            $crypt_key = self::getCryptKey();

            $value = ICrypt::encrypt($crypt_key . $value);
            $value = NumeralSystem::bin2hex($value);
        }

        return $value;
    }

    /**
     * Decrypts a value
     *
     * @param $value
     * @return array
     */
    public static function decrypt(string $value) : array
    {
        if (self::getConfig() === true) {
            try {
                $value = NumeralSystem::hex2bin($value);
                $value = ICrypt::decrypt($value);

                $decryptedKey = mb_substr($value, 0, 5);
                $value = mb_substr($value, 5);

                $crypt_key = self::getCryptKey();

                if ($crypt_key !== $decryptedKey) {
                    return ['valid' => false];
                }
            } catch (\Exception $e) {
                return ['valid' => false];
            }
        }

        return ['valid' => true, 'value' => $value];
    }

    /**
     * Store a new encryption key in the session
     */
    public static function setCryptKey()
    {
        Session::put('crypt_key', Str::random(5));
    }

    /**
     * Returns the session's random encryption key
     *
     * @return mixed
     */
    private static function getCryptKey()
    {
        return Session::get('crypt_key');
    }

    /**
     * Returns the encryption settings
     *
     * @return mixed
     */
    private static function getConfig()
    {
        return config('system.crypt.mode');
    }
}
