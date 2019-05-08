<?php

/**
 * Cria um cabeçalho da tabela com links para ordenação
 * @param string $field Campo que irá pra url
 * @param string $label Exibição do nome da coluna
 * @param string $order campo que está sendo ordenado no momento, para exibir a seta
 * @param string $way sentido da ordenação, para exibir a seta no sentido correto
 * @param array $class array para alterar a classe padrão do ícone de ordenação
 * @param bool $defaultOrder identificador de filtro padrão, para adicionar ícone de ordenação caso nenhuma esteja sendo aplicada na url
 * @return string
 */
function buildTableHeader($field, $label, $order, $way, array $class = array(), $defaultOrder = false)
{
    $up = $class['up'] ?? 'fa fa-chevron-circle-up';
    $down = $class['down'] ?? 'fa fa-chevron-circle-down';
    $default = $class['default'] ?? 'fa fa-sort';

    $href = request()->fullUrlWithQuery(['sort' => $field, 'way' => $way == 'asc' ? 'desc' : 'asc']);
    $iconClass = empty($order) ? ($defaultOrder == $field ?  (empty($order) ? $down : $up)  : $default) : ($order == $field ? ($way == 'asc' ? $down : $up) : $default);
    $icon = "<i class='{$iconClass}'></i>";

    return "<a href='{$href}'>{$label} {$icon}</a>";
}