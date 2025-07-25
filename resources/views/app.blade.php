<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        @routes
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
        @inertiaHead

        {{-- İnternet Hız Testi Sayfası İçin JSON-LD --}}
        @if(request()->routeIs('internet-speed-test'))
            <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "WebPage",
                  "name": "İnternet Hız Testi",
                  "url": "http://fast-teknik.test.test/internet-hiz-testi", {{-- Burayı canlı domaininize göre GÜNCELLEYİN --}}
                  "description": "İzmir'de ücretsiz internet hız testi yapın. Fast Teknik ile anında bağlantı hızınızı öğrenin.",
                  "publisher": {
                    "@type": "Organization",
                    "name": "Fast Teknik"
                  }
                }
            </script>
        @endif

    </head>
    <body class="font-sans antialiased bg-white">
        @inertia
    </body>
</html>
