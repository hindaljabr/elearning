<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class AdminAccess
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ( $this->auth->check() ) {
            if ( $this->auth->guard()->user()->type == User::ADMIN ) {
                // we are logged in to an admin account
                return $next($request);
            } else {
                return redirect()->route('home')
                                ->with('error', 'You do not have enough privilege to access that page');
            }
        } else {
            return redirect()->route('home')->with('error', 'Please log in to continue');
        }
    }
}
