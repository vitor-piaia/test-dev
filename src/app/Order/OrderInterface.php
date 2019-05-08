<?php

namespace App\Order;


interface OrderInterface
{
    public function apply($model);
}