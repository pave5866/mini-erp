<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        // Kullanıcı giriş yapmamışsa
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'Bu sayfaya erişmek için giriş yapmalısınız.');
        }
        
        // Kullanıcının izni varsa devam et
        if ($request->user()->hasPermission($permission)) {
            return $next($request);
        }
        
        // İzin yoksa 403 hatası göster
        abort(403, 'Bu işlemi yapmak için yetkiniz bulunmamaktadır.');
    }
} 