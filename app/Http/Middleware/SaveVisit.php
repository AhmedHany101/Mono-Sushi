<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaveVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $existingVisit = Visit::where('ip_address', $request->ip())
            ->where('visited_at', '>=', now()->subMinutes(10)) // Only consider visits in the last 10 minutes
            ->first();
    
        if (!$existingVisit) {
            $visit = new visit();
            $visit->ip_address = $request->ip();
            $userAgent= $request->header('User-Agent');
            $browserName = $this->getBrowserName($userAgent);
            $visit->user_agent =$browserName;
            $visit->visited_at = now();
            $visit->save();
        }
    
        return $next($request);
    }
    private function getBrowserName($userAgent)
    {
        $browserName = 'Unknown';

        // Define regular expressions to match common browsers
        $patterns = [
            '/(MSIE|Trident)/i' => 'Internet Explorer',
            '/Firefox/i' => 'Firefox',
            '/Edge/i' => 'Microsoft Edge',
            '/Chrome/i' => 'Chrome',
            '/Safari/i' => 'Safari',
            '/Opera/i' => 'Opera',
        ];

        // Check if the user agent matches any of the patterns
        foreach ($patterns as $pattern => $name) {
            if (preg_match($pattern, $userAgent)) {
                $browserName = $name;
                break;
            }
        }

        return $browserName;
    }
}
