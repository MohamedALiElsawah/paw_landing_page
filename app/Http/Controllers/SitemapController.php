<?php

namespace App\Http\Controllers;

use App\Services\SEOService;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\Store;
use App\Models\PetPost;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap
     */
    public function index()
    {
        $sitemap = SEOService::generateDynamicSitemap();

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Generate robots.txt
     */
    public function robots()
    {
        $robots = SEOService::generateRobotsTxt();

        return response($robots, 200)
            ->header('Content-Type', 'text/plain');
    }
}
