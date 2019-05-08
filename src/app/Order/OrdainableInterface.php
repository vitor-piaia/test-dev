<?php

namespace App\Order;

interface OrdainableInterface
{
    /**
     * Devolve valor da constant __NAMESPACE__
     * @return string
     */
    public static function getNamespace();
}