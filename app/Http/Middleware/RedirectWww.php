<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectWww
{
    /**
     * Handle an incoming request.
     *
     * Redirects www subdomain to non-www version for SEO canonical URL.
     * Example: www.fastteknik.com → fastteknik.com (301 permanent redirect)
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        
        // Check if the host starts with 'www.'
        if (str_starts_with($host, 'www.')) {
            // Remove 'www.' from the host
            $nonWwwHost = substr($host, 4);
            
            // Build the new URL without www
            $newUrl = $request->getScheme() . '://' . $nonWwwHost . $request->getRequestUri();
            
            // 301 Permanent Redirect (SEO friendly)
            return redirect()->to($newUrl, 301);
        }

        return $next($request);
    }
}

