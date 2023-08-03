<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class HRCustomerServiceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  User Type:  1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
        if (!empty(Auth::check()))
        {
            if (Auth::user()->user_type == 5)
            {
                return $next($request);
            }
            else
            {
                Auth::logout();
                return redirect(url(''));
            }

        }
        else
        {
            Auth::logout();
            return redirect(url(''));
        }

    }
}
