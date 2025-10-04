<!DOCTYPE html>
<html lang="tr" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="/fast-favicon/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="/fast-favicon/favicon.svg" />
        <link rel="shortcut icon" href="/fast-favicon/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="/fast-favicon/apple-touch-icon.png" />
        <link rel="manifest" href="/fast-favicon/site.webmanifest" />

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

        {{-- Resource Hints for Performance --}}
        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
        <link rel="dns-prefetch" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com">
        <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
        
        {{-- Preload critical fonts for LCP (both 400 and 600 weight) --}}
        <link rel="preload" href="https://fonts.bunny.net/instrument-sans/files/instrument-sans-latin-400-normal.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="https://fonts.bunny.net/instrument-sans/files/instrument-sans-latin-600-normal.woff2" as="font" type="font/woff2" crossorigin>
        
        {{-- Inline critical font-face for instant render --}}
        <style>
        @font-face{font-family:'Instrument Sans';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.bunny.net/instrument-sans/files/instrument-sans-latin-400-normal.woff2) format('woff2');}
        @font-face{font-family:'Instrument Sans';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.bunny.net/instrument-sans/files/instrument-sans-latin-600-normal.woff2) format('woff2');}
        </style>
        
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />
        
        {{-- Font Awesome - Defer loading for better LCP --}}
        <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

        {{-- Google Analytics 4 (GA4) --}}
        @production
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-2DW9PGYTDR"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', 'G-2DW9PGYTDR', {
                    'anonymize_ip': true,
                    'cookie_flags': 'SameSite=None;Secure'
                });
            </script>
        @endproduction

        @routes
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
        @inertiaHead

        {{-- Combined Organization + LocalBusiness JSON-LD --}}
        <script type="application/ld+json">{"@context":"https://schema.org","@graph":[{"@type":"Organization","name":"Fast Teknik","url":"{{ config('app.url') }}","logo":"{{ config('app.url') }}/images/logo.png","description":"İzmir'de profesyonel teknik servis hizmetleri","address":{"@type":"PostalAddress","addressLocality":"İzmir","addressCountry":"TR"},"sameAs":["https://www.instagram.com/fastteknik"],"contactPoint":{"@type":"ContactPoint","telephone":"+90-546-911-8061","contactType":"customer service","areaServed":"TR","availableLanguage":"Turkish"},"priceRange":"$$"},{"@type":"LocalBusiness","name":"Fast Teknik","image":"{{ config('app.url') }}/images/logo.png","@id":"{{ config('app.url') }}","url":"{{ config('app.url') }}","telephone":"+90-546-911-8061","address":{"@type":"PostalAddress","streetAddress":"İzmir","addressLocality":"İzmir","addressCountry":"TR"},"geo":{"@type":"GeoCoordinates","latitude":38.4237,"longitude":27.1428},"openingHoursSpecification":{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"opens":"09:00","closes":"18:00"},"priceRange":"$$"}]}</script>

        {{-- İnternet Hız Testi Sayfası İçin JSON-LD --}}
        @if(request()->routeIs('internet-speed-test'))
            <script type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"İnternet Hız Testi","url":"{{ route('internet-speed-test') }}","description":"İzmir'de ücretsiz internet hız testi yapın","publisher":{"@type":"Organization","name":"Fast Teknik","logo":{"@type":"ImageObject","url":"{{ config('app.url') }}/images/logo.png"}},"breadcrumb":{"@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Ana Sayfa","item":"{{ config('app.url') }}"},{"@type":"ListItem","position":2,"name":"İnternet Hız Testi","item":"{{ route('internet-speed-test') }}"}]}}</script>
        @endif

    </head>
    <body class="font-sans antialiased bg-white">
        @inertia
    </body>
</html>
