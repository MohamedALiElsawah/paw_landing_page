<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\Store;
use App\Models\PetPost;
use Illuminate\Support\Facades\Storage;

class SEOService
{
    /**
     * Generate meta tags for a page
     */
    public static function generateMetaTags($title = null, $description = null, $keywords = null, $image = null, $url = null, $type = 'website')
    {
        $siteName = Setting::getValue('site_name', 'PawApp');
        $defaultTitle = Setting::getValue('meta_title', 'PawApp - Pet Care Services');
        $defaultDescription = Setting::getValue('meta_description', 'Find the best pet care services, clinics, and stores near you.');
        $defaultKeywords = Setting::getValue('meta_keywords', 'pet care, veterinary, pet stores, animal clinics');
        $ogImage = Setting::getValue('og_image') ? asset(Storage::url(Setting::getValue('og_image'))) : asset('assets/images/og-default.jpg');

        $metaTags = [
            'title' => $title ? "{$title} - {$siteName}" : $defaultTitle,
            'description' => $description ?: $defaultDescription,
            'keywords' => $keywords ?: $defaultKeywords,
            'og_title' => $title ?: $defaultTitle,
            'og_description' => $description ?: $defaultDescription,
            'og_image' => $image ?: $ogImage,
            'og_url' => $url ?: url()->current(),
            'og_type' => $type,
            'twitter_card' => 'summary_large_image',
            'twitter_title' => $title ?: $defaultTitle,
            'twitter_description' => $description ?: $defaultDescription,
            'twitter_image' => $image ?: $ogImage,
        ];

        return $metaTags;
    }

    /**
     * Generate JSON-LD schema markup
     */
    public static function generateSchemaMarkup($type = 'Organization', $data = [])
    {
        $defaultSchema = Setting::getValue('organization_schema');
        if ($defaultSchema) {
            return json_decode($defaultSchema, true);
        }

        $baseSchema = [
            '@context' => 'https://schema.org',
            '@type' => $type,
        ];

        switch ($type) {
            case 'Organization':
                $baseSchema['name'] = Setting::getValue('site_name', 'PawApp');
                $baseSchema['description'] = Setting::getValue('site_description', 'Your trusted pet care companion');
                $baseSchema['url'] = url('/');
                $baseSchema['logo'] = asset('assets/icons/logo.svg');
                $baseSchema['telephone'] = Setting::getValue('phone_number');
                $baseSchema['email'] = Setting::getValue('email');
                $baseSchema['address'] = [
                    '@type' => 'PostalAddress',
                    'streetAddress' => Setting::getValue('address'),
                ];
                $baseSchema['sameAs'] = array_filter([
                    Setting::getValue('facebook_url'),
                    Setting::getValue('instagram_url'),
                    Setting::getValue('twitter_url'),
                    Setting::getValue('linkedin_url'),
                ]);
                break;

            case 'LocalBusiness':
                $baseSchema['name'] = Setting::getValue('site_name', 'PawApp');
                $baseSchema['description'] = Setting::getValue('site_description', 'Your trusted pet care companion');
                $baseSchema['url'] = url('/');
                $baseSchema['telephone'] = Setting::getValue('phone_number');
                $baseSchema['address'] = [
                    '@type' => 'PostalAddress',
                    'streetAddress' => Setting::getValue('address'),
                ];
                $baseSchema['openingHours'] = Setting::getValue('working_hours');
                $baseSchema['priceRange'] = '$$';
                break;

            case 'WebSite':
                $baseSchema['name'] = Setting::getValue('site_name', 'PawApp');
                $baseSchema['url'] = url('/');
                $baseSchema['description'] = Setting::getValue('site_description', 'Your trusted pet care companion');
                break;
        }

        return array_merge($baseSchema, $data);
    }

    /**
     * Generate analytics scripts
     */
    public static function generateAnalyticsScripts()
    {
        $scripts = [];

        // Google Analytics
        $gaId = Setting::getValue('google_analytics_id');
        if ($gaId) {
            $scripts[] = "
                <!-- Google tag (gtag.js) -->
                <script async src=\"https://www.googletagmanager.com/gtag/js?id={$gaId}\"></script>
                <script>
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag('js', new Date());
                    gtag('config', '{$gaId}');
                </script>
            ";
        }

        // Facebook Pixel
        $pixelId = Setting::getValue('facebook_pixel_id');
        if ($pixelId) {
            $scripts[] = "
                <!-- Facebook Pixel Code -->
                <script>
                    !function(f,b,e,v,n,t,s)
                    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window, document,'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                    fbq('init', '{$pixelId}');
                    fbq('track', 'PageView');
                </script>
                <noscript>
                    <img height=\"1\" width=\"1\" style=\"display:none\"
                         src=\"https://www.facebook.com/tr?id={$pixelId}&ev=PageView&noscript=1\"/>
                </noscript>
            ";
        }

        return implode("\n", $scripts);
    }

    /**
     * Generate meta verification tags
     */
    public static function generateVerificationTags()
    {
        $tags = [];

        // Google Search Console
        $googleVerification = Setting::getValue('google_search_console');
        if ($googleVerification) {
            $tags[] = "<meta name=\"google-site-verification\" content=\"{$googleVerification}\">";
        }

        return implode("\n", $tags);
    }

    /**
     * Generate dynamic sitemap XML with all content
     */
    public static function generateDynamicSitemap()
    {
        $baseUrl = url('/');
        $priority = Setting::getValue('sitemap_priority', '0.8');
        $lastmod = date('Y-m-d');

        $urls = [
            [
                'loc' => $baseUrl,
                'lastmod' => $lastmod,
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
        ];

        // Add clinics to sitemap
        $clinics = Clinic::all();
        foreach ($clinics as $clinic) {
            $urls[] = [
                'loc' => url("/clinics/{$clinic->id}"),
                'lastmod' => $clinic->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }

        // Add services to sitemap
        $services = Service::all();
        foreach ($services as $service) {
            $urls[] = [
                'loc' => url("/services/{$service->id}"),
                'lastmod' => $service->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // Add stores to sitemap
        $stores = Store::all();
        foreach ($stores as $store) {
            $urls[] = [
                'loc' => url("/stores/{$store->id}"),
                'lastmod' => $store->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // Add pet posts to sitemap
        $petPosts = PetPost::all();
        foreach ($petPosts as $post) {
            $urls[] = [
                'loc' => url("/pet-posts/{$post->id}"),
                'lastmod' => $post->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.6'
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($urls as $url) {
    $xml .= '<url>';
        $xml .= "<loc>{$url['loc']}</loc>";
        $xml .= "<lastmod>{$url['lastmod']}</lastmod>";
        $xml .= "<changefreq>{$url['changefreq']}</changefreq>";
        $xml .= "<priority>{$url['priority']}</priority>";
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

return $xml;
}

/**
* Generate sitemap XML (legacy method)
*/
public static function generateSitemap()
{
return self::generateDynamicSitemap();
}

/**
* Generate robots.txt content
*/
public static function generateRobotsTxt()
{
$customRobots = Setting::getValue('custom_robots_txt');

if ($customRobots) {
return $customRobots;
}

return "User-agent: *\n" .
"Allow: /\n" .
"Disallow: /admin/\n" .
"Disallow: /login\n" .
"Sitemap: " . url('/sitemap.xml') . "\n";
}

/**
* Generate Open Graph tags
*/
public static function generateOpenGraphTags($title, $description, $image = null, $url = null, $type = 'website')
{
$ogImage = $image ?: (Setting::getValue('og_image') ? asset(Storage::url(Setting::getValue('og_image'))) :
asset('assets/images/og-default.jpg'));
$siteName = Setting::getValue('site_name', 'PawApp');

return [
'og:title' => $title,
'og:description' => $description,
'og:image' => $ogImage,
'og:url' => $url ?: url()->current(),
'og:type' => $type,
'og:site_name' => $siteName,
'og:locale' => app()->getLocale(),
];
}

/**
* Generate Twitter Card tags
*/
public static function generateTwitterCardTags($title, $description, $image = null)
{
$twitterImage = $image ?: (Setting::getValue('og_image') ? asset(Storage::url(Setting::getValue('og_image'))) :
asset('assets/images/og-default.jpg'));

return [
'twitter:card' => 'summary_large_image',
'twitter:title' => $title,
'twitter:description' => $description,
'twitter:image' => $twitterImage,
];
}
}