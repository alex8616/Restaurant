<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\User;
use App\Notifications\ClienteNotification;
use Illuminate\Support\Facades\Notification;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $users = User::all();
        $news = Cliente::whereRaw("TIMESTAMPDIFF(YEAR, FechaNacimiento_cliente, CURDATE()) < TIMESTAMPDIFF(YEAR, FechaNacimiento_cliente, ADDDATE(CURDATE(), 2))")
                            ->get()->each(function($clientes) use ($users) {
            Notification::send($users, new ClienteNotification($clientes));
        });  

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
