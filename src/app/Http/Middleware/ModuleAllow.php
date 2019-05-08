<?php

namespace App\Http\Middleware;

use Closure;

class ModuleAllow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $module
     * @return mixed
     */
    public function handle($request, Closure $next, string $module)
    {
        // se módulo estiver desabilitado, é devolvido um 404 para o usuário
        if (!config("system.modules.{$module}.active")) {
            abort(404);
        }

        return $next($request);
    }
}
