<?php

/**
 * Verifica se a página inserida na URL é válida, se falsa ela retorna a última página válida.
 * @param $paginator
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
function validatePage($paginator)
{
    if(empty($paginator->items()) && ($paginator->currentPage() != 1)){
       return redirect(($paginator->url($paginator->lastPage())));
    }
}