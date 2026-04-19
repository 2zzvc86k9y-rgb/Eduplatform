<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if(Auth::check()){
            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . Auth::user()->id, true, $expireTime);
            User::where('id',Auth::user()->id)->update(['last_seen' => Carbon::now()]);

        }




        $userRole = $request->user()->role;
        if ($userRole === 'user' && $userRole !== 'user') {
            return redirect('/dashboard');
        }elseif($userRole === 'admin' && $userRole === 'user'){
            return redirect('/admin/dashboard');
        }
        elseif($userRole === 'instructor' && $userRole === 'user'){
            return redirect('/instructor/dashboard');
        }
        elseif($userRole === 'admin' && $userRole === 'instructor'){
            return redirect('/admin/dashboard');
        }
        elseif($userRole === 'instructor' && $userRole === 'admin'){
            return redirect('/instructor/dashboard');
        }
        return $next($request);
    }
}
