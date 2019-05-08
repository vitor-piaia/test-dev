<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CORS
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
        header("Access-Control-Allow-Origin: *");

        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin, Authorization',
            'Access-Control-Expose-Headers' => 'X-Pagination-Count, X-Pagination-Page, X-Pagination-Limit'
        ];

        if($request->getMethod() == "OPTIONS") {
            $response = new Response();
            foreach($headers as $key => $value){
                $response->headers->set($key, $value);
            }

            return $response;
        }

        $response = $next($request);
        foreach($headers as $key => $value){
            $response->header($key, $value);
        }

        return $response;
    }

}