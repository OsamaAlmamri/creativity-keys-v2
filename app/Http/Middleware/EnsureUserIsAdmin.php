<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ?string $role = null): Response
    {
        if (! $request->user()) {
            return redirect()->route('admin.login');
        }

        if (! $request->user()->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->withErrors(['email' => 'هذا الحساب معطل حالياً. يرجى مراجعة الإدارة.']);
        }

        if ($role === 'admin' && ! $request->user()->isAdmin()) {
            abort(403, 'عذراً، هذه العملية تتطلب صلاحية مدير النظام الكاملة.');
        }

        return $next($request);
    }
}
