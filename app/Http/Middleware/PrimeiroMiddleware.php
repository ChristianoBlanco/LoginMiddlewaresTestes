<?php

namespace App\Http\Middleware;

use Closure;
use Log;
class PrimeiroMiddleware
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
        
        Log::debug('Passou pelo Primeiro Middleware ANTES !');
        //return $next($request);
        //return response('Break no primeiro middleware');
        
        //Tudo que for executado antes do $next não passa pelo controller
        $response = $next($request);

        Log::debug('Passou pelo Primeiro Middleware DEPOIS !');
        //return $response;
        return response('Alterei a resposta.');
    }
}
