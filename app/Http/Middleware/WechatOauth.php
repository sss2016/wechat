<?php

namespace App\Http\Middleware;

use Closure;

class WechatOauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $wechat = app('wechat');
        if (empty(session('openid'))) {

            if ($request->has('state') && $request->has('code')) {
                $user = $wechat->oauth->user();

                $openid = $user->getId();
                session(['openid' => $openid]);

                return $next($request);
            }

            return $wechat->oauth->redirect($request->fullUrl());
        }

        return $next($request);
    }
}