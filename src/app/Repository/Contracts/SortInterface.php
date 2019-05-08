<?php

namespace App\Repository\Contracts;

use App\Order\OrderInterface;

interface SortInterface
{
    /**
     * Retorna os critérios
     * @return OrderInterface
     */
    public function getOrder();

    /**
     * Adiciona um novo critério
     * @param OrderInterface $criteria
     * @return $this
     */
    public function pushOrder(OrderInterface $criteria);

    /**
     * Aplicação dos critérios de ordenação
     * @return $this
     */
    public function applyOrder();
}