<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class checkSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::with('subscription')->whereid($request->user()->id)->first();
        if($user->role_id=='1')
        {
        if(is_null($user->subscription)){
            return redirect()->route('subscription.index');
        }
    }
        return $next($request);
    }
}
