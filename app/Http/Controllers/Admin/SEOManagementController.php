<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SEOService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SEOManagementController extends Controller
{
    /**
     * Display SEO management dashboard
     */
    public function index()
    {
        $seoSettings = [
            'meta_title' => Setting::getValue('meta_title'),
            'meta_description' => Setting::getValue('meta_description'),
            'meta_keywords' => Setting::getValue('meta_keywords'),
            'google_analytics_id' => Setting::getValue('google_analytics_id'),
            'facebook_pixel_id' => Setting::getValue('facebook_pixel_id'),
            'google_search_console' => Setting::getValue('google_search_console'),
            'organization_schema' => Setting::getValue('organization_schema'),
            'custom_robots_txt' => Setting::getValue('custom_robots_txt'),
            'sitemap_priority' => Setting::getValue('sitemap_priority', '0.8'),
            'og_image' => Setting::getValue('og_image'),
        ];

        // Generate sitemap preview
        $sitemapPreview = SEOService::generateDynamicSitemap();
        $robotsPreview = SEOService::generateRobotsTxt();

        return view('admin.seo.index', compact('seoSettings', 'sitemapPreview', 'robotsPreview'));
    }

    /**
     * Update SEO settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'google_analytics_id' => 'nullable|string|max:50',
            'facebook_pixel_id' => 'nullable|string|max:50',
            'google_search_console' => 'nullable|string',
            'organization_schema' => 'nullable|json',
            'custom_robots_txt' => 'nullable|string',
            'sitemap_priority' => 'nullable|numeric|min:0.1|max:1.0',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($validated as $key => $value) {
            if ($key !== 'og_image') {
                Setting::setValue($key, $value);
            }
        }

        // Handle Open Graph image upload
        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('seo', 'public');
            Setting::setValue('og_image', $path);
        }

        // Regenerate sitemap and robots.txt
        $this->regenerateSEOFiles();

        return redirect()->route('admin.seo.index')
            ->with('success', 'SEO settings updated successfully!');
    }

    /**
     * Regenerate SEO files
     */
    public function regenerate()
    {
        $this->regenerateSEOFiles();

        return redirect()->route('admin.seo.index')
            ->with('success', 'SEO files regenerated successfully!');
    }

    /**
     * Preview sitemap
     */
    public function previewSitemap()
    {
        $sitemap = SEOService::generateDynamicSitemap();

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Preview robots.txt
     */
    public function previewRobots()
    {
        $robots = SEOService::generateRobotsTxt();

        return response($robots, 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Regenerate SEO files
     */
    private function regenerateSEOFiles()
    {
        // In a production environment, you would save these files to disk
        // For now, we'll just generate them on-the-fly
        $sitemap = SEOService::generateDynamicSitemap();
        $robots = SEOService::generateRobotsTxt();

        // You could save these files to public directory:
        // Storage::disk('public')->put('sitemap.xml', $sitemap);
        // Storage::disk('public')->put('robots.txt', $robots);

        return true;
    }

    /**
     * Get SEO analytics data (placeholder for future implementation)
     */
    public function analytics()
    {
        // This would integrate with Google Analytics API
        $analyticsData = [
            'sessions' => 0,
            'users' => 0,
            'pageviews' => 0,
            'bounce_rate' => 0,
            'avg_session_duration' => 0,
        ];

        return view('admin.seo.analytics', compact('analyticsData'));
    }
}
