<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'appUrl' => config('app.url') ?: $request->root(),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'flash' => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ],
            'seo' => $this->getSeoData($request),
        ];
    }

    /**
     * Get SEO data for current route
     * 
     * Priority: Controller > Config > Default
     */
    protected function getSeoData(Request $request): array
    {
        $routeName = $request->route()?->getName();
        
        // Config'den route'a özel SEO bilgisi al
        $seoConfig = config("seo.routes.{$routeName}") ?? config('seo.default');
        
        // OG image ve canonical URL'i tam path yap
        $ogImage = $seoConfig['og_image'] ?? config('seo.default.og_image');
        $ogImage = str_starts_with($ogImage, 'http') ? $ogImage : asset($ogImage);
        
        return [
            'title' => $seoConfig['title'] ?? config('seo.default.title'),
            'description' => $seoConfig['description'] ?? config('seo.default.description'),
            'keywords' => $seoConfig['keywords'] ?? config('seo.default.keywords'),
            'og_image' => $ogImage,
            'canonical' => url()->current(),
        ];
        
        // NOT: Controller'dan manuel SEO gönderilirse (props['seo']),
        // o otomatik olarak bu değerleri override eder (merge ediliyor).
    }
}
