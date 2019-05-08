<?php

namespace App\Http\Middleware;

use App\Crypt\Crypt;
use Closure;

class DecryptParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $params = $request->route()->parameters();

        // verificação se rota necessita de criptografia
        if (in_array(request()->route()->getName(), $this->noCryptedRoutes())) {
            return $next($request);
        }

        $hasError = false;
        array_walk_recursive($params, function ($value, $key) use (&$hasError) {
            $decrypted = Crypt::decrypt($value);
            $hasError = ($decrypted['valid'] === false && $hasError === false) ? true : false;

            if (!$hasError) {
                request()->route()->setParameter($key, $decrypted['value']);
            }
        });

        if ($hasError) {
            $prefix = substr(request()->route()->getPrefix(), 1);

            $array = [
                'adm' => 'adm',
            ];

            return redirect()->route($array[$prefix] . '.logout');
        }

        return $next($request);
    }

    /**
     * Nome de rotas que não utilizarão criptografia
     * @param string|null $key
     * @return array|bool|mixed
     */
    private function noCryptedRoutes(string $key = null)
    {
        $array = [
            'adm.recovery',
            'adm.ajax.search.cep',
            'adm.ajax.address',
            'adm.ajax.search.product',
            'adm.ajax.product.edit',
            'adm.ajax.search.category',
            'adm.ajax.search.item',
            'adm.ajax.product.configure',
        ];

        return array_key_exists($key, $array) ? $array[$key] : (!empty($key) && strlen($key) > 0 ? false : $array);
    }
}
