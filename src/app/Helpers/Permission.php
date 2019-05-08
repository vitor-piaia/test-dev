<?php

/**
 * Verifica permissão em múltiplos recursos
 * caso o usuário não tenha permissão é redirecionado para tela de permissão
 *
 * @param array $permissions
 * @return bool
 */
function can_abort(array $permissions) : bool
{
    foreach ($permissions as $permission) {
        if (\Gate::check($permission)) {
            return true;
        }
    }
    return abort(403);
}

/**
 * Verifica permissão em múltiplos recursos
 * Retorna um bool (true, false)
 *
 * @param array $permissions
 * @return bool
 */
function can_verify(array $permissions) : bool
{
    foreach ($permissions as $permission) {
        if (\Gate::check($permission)) {
            return true;
        }
    }
    return false;
}
