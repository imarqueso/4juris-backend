<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddCsrfToken
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post')) {
            $token = $request->header('X-CSRF-TOKEN');

            if ($token !== csrf_token()) {
                return response()->json(['message' => 'CSRF token mismatch'], 403);
            }
        }

        return $next($request);
    }
}
