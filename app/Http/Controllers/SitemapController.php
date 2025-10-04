<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap for SEO with dynamic content
     */
    public function index(): Response
    {
        // Static important pages
        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => now()->toW3cString(),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ],
            [
                'loc' => route('services.index'),
                'lastmod' => now()->toW3cString(),
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ],
            [
                'loc' => route('services.camera'),
                'lastmod' => now()->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => route('services.internet'),
                'lastmod' => now()->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => route('services.satellite'),
                'lastmod' => now()->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => route('internet-speed-test'),
                'lastmod' => now()->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'loc' => route('contact'),
                'lastmod' => now()->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ],
        ];

        // Add dynamic services from database
        $services = Service::where('is_active', true)->get();
        foreach ($services as $service) {
            $urls[] = [
                'loc' => route('services.show', $service->slug),
                'lastmod' => $service->updated_at->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>';
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }
        
        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}

