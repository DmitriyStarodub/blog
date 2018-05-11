<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class VerifyAPIToken
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
        $validator = Validator::make($request->all(), [
            'token' => ['required', 'exists:users,token']
        ]);

        if ($validator->fails()) {

            $status = 0;
            $error = $validator->messages();

            return compact('status', 'error');
        }

        return $next($request);
    }
}
