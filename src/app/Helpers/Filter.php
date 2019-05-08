<?php

/**
 * Cria o texto de resumo com os filtros escolhidos
 * @param array $filters
 * @return string
 */
function buildFilter(array $filters) : string
{
    $array = [];
    foreach($filters as $filter){
        if($filter['check']){
            $array[] = "<strong>{$filter['label']}: </strong>{$filter['value']}";
        }
    }

    return implode(', ', $array);
}