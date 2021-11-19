<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class email
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
        $user = User::where(['email' => $request->email])->first();
        if($user->email_verified_at !== null){

            return $next($request);

        } else {

            Alert::error('Email not confirmed', 'Please Confirm Email First');
            $request->session()->put('email', $request->email);
            return redirect("confirm-email");
            
        }
        return $next($request);
    }
}
