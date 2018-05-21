<?php
    namespace App\Http\Middleware;
    use Closure;
    class Settings
    {
        public function handle($request, Closure $next)
        {
            if(auth()->check()) {
                $settings = json_decode(auth()->user()->settings);
                config(['app.pagination' => $settings->pagination]);
            }
            return $next($request);
        }
    }