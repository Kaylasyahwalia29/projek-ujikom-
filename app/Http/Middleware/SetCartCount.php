<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Keranjang;

class SetCartCount
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $count = Keranjang::where('user_id', auth()->id())->count();
            session(['cart_count' => $count]);
        }

        return $next($request);
    }
}
