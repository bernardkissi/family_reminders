<?php

namespace App\Http\Middleware;

use App\Models\Contribution;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ValidateContribution
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
        $contribute = Contribution::where('slug', $request->contribute->slug)->first();
        $expires_on = Carbon::create($contribute->expires_on);
        $today = Carbon::now();

        if($today->gt($expires_on)){
            return response()->json(['message' => 'Contribution has been closed'], 404);
        }
        return $next($request);
    }
}
