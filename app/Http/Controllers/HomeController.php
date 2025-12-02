<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Service;
use App\Models\Store;
use App\Models\PetPost;
use App\Models\Review;
use App\Models\Partner;
use App\Models\Banner;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        $stores = Store::where('is_active', true)->orderBy('order')->get();
        $clinics = Clinic::where('is_active', true)->orderBy('order')->get();
        $petPosts = PetPost::where('is_published', true)->get();
        $reviews = Review::where('is_approved', true)->get();
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        $banners = Banner::active()->orderByRaw('is_default DESC, `order` ASC')->get();

        return view('home', compact(
            'services',
            'stores',
            'clinics',
            'petPosts',
            'reviews',
            'partners',
            'banners'
        ));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string'
        ]);

        ContactSubmission::create($request->all());

        return back()->with('success', __('Thank you for your message. We will get back to you soon!'));
    }

    public function changeLocale($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }

        return back();
    }

    public function privacy()
    {
        return view('privacy');
    }
}
