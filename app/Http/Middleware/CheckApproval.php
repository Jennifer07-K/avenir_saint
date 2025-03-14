<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // dd([
        //     'user' => $request->user(),
        //     'approved' => $request->user()?->approved,
        //     'role' => $request->user()?->role,
        // ]);


        // if ($request->user() && $request->user()->role === 'clinic' && !$request->user()->approved) {
        //     return redirect('/dashboard')->with('error', 'Votre compte est en attente d’approbation par un administrateur.');
        // }
        // if ($request->user() && !$request->user()->approved) {
        //     return redirect('/dashboard')->with('error', 'Votre compte est en attente d’approbation.');
        // }
       
        if ($request->user() && $request->user()->role === 'clinic' && !$request->user()->approved) {
            Auth::logout(); 
            return redirect('/login')->with('error', 'Votre compte est en attente d’approbation par un administrateur.');
        }

        return $next($request);
    }
}
