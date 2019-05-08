<?php

namespace App\Service;

use App\Repository\OrderRepository;

class OrderService
{
    /** @var OrderRepository $orderRepository */
    protected $orderRepository;

    /**
     * OrderService constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
}
