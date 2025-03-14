<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user() && $request->user()->role === 'clinic') {
            if (! $request->user()->approved) {
                return redirect('/dashboard')->with('error', 'Votre compte est en attente d’approbation.');
            }
            if (! $request->user()->subscription || ! $request->user()->subscription->is_active) {
                return redirect('/dashboard')->with('error', 'Votre abonnement n’est pas actif. Contactez l’administrateur.');
            }
        }
        return $next($request);
    }
}
