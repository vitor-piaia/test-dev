<?php

namespace App\Order;

use App\Repository\Contracts\SortInterface;
use Illuminate\Http\Request;

trait OrdainableTrait
{
    public static function apply(SortInterface $repository, Request $order)
    {
        static::applyDecoratorsFromRequest($order, $repository);
    }

    private static function applyDecoratorsFromRequest(Request $request, SortInterface $repository)
    {
        $orderName = $request->get('sort');
        $way = $request->get('way') ?? 'asc';

        if($orderName != null){
            $decorator = static::createFilterDecorator($orderName);

            if (static::isValidDecorator($decorator)) {
                $repository->pushOrder(new $decorator($way));
            }
        }
    }

    private static function createFilterDecorator(string $name)
    {
        return static::getNamespace() . '\\Conditions\\' . str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    private static function isValidDecorator(string $decorator)
    {
        return class_exists($decorator);
    }
}