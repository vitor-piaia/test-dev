<?php

namespace App\Order\Ticket;

use App\Order\OrdainableInterface;
use App\Order\OrdainableTrait;

class TicketOrder implements OrdainableInterface
{
    /**
     * Devolve valor da constant __NAMESPACE__
     * @return string
     */
    public static function getNamespace()
    {
        return __NAMESPACE__;
    }

    use OrdainableTrait;
}