<?php

namespace App\Filter;

interface SearcheableInterface
{
    /**
     * Devolve valor da constant __NAMESPACE__
     * @return string
     */
    public static function getNamespace();
}