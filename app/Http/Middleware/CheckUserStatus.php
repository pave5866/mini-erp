<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;

class CheckUserStatus
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->status) {
            Auth::logout();
            
            $this->logger->warning('Pasif kullanıcı giriş denemesi', [
                'user_id' => Auth::id(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return redirect()->route('login')
                ->with('error', 'Hesabınız pasif durumda. Lütfen yönetici ile iletişime geçin.');
        }

        return $next($request);
    }
} 