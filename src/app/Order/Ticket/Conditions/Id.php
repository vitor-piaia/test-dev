<?php

namespace App\Order\Ticket\Conditions;

use App\Order\OrderInterface;
use Illuminate\Database\Eloquent\Builder;

class Id implements OrderInterface
{
    /**
     * @var string $way
     */
    private $way;

    public function __construct($way)
    {
        $this->way = $way;
    }

    /**
     * @param Builder $model
     * @return mixed
     */
    public function apply($model)
    {
        if ($this->way === null) {
            return $model;
        }

        $query = $model->orderBy('id', $this->way);
        return $query;
    }
}
