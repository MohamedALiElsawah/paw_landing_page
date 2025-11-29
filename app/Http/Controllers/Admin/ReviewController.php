<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Clinic;
use App\Models\Store;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('reviewable')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $clinics = Clinic::all();
        $stores = Store::all();
        $services = Service::all();

        return view('admin.reviews.create', compact('clinics', 'stores', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reviewer_name_en' => 'required|string|max:255',
            'reviewer_name_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'reviewer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'reviewable_type' => 'required|string|in:clinic,store,service',
            'reviewable_id' => 'required|integer',
            'is_approved' => 'boolean',
        ]);

        $reviewerImagePath = null;
        if ($request->hasFile('reviewer_image')) {
            $reviewerImagePath = $request->file('reviewer_image')->store('reviews', 'public');
        }

        // Determine the reviewable model class
        $reviewableClass = match ($request->reviewable_type) {
            'clinic' => Clinic::class,
            'store' => Store::class,
            'service' => Service::class,
        };

        Review::create([
            'reviewer_name' => json_encode([
                'en' => $request->reviewer_name_en,
                'ar' => $request->reviewer_name_ar,
            ]),
            'content' => json_encode([
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ]),
            'rating' => $request->rating,
            'reviewer_image' => $reviewerImagePath,
            'date' => $request->date,
            'reviewable_type' => $reviewableClass,
            'reviewable_id' => $request->reviewable_id,
            'is_approved' => $request->is_approved ?? true,
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully.');
    }

    public function edit(Review $review)
    {
        $clinics = Clinic::all();
        $stores = Store::all();
        $services = Service::all();

        return view('admin.reviews.edit', compact('review', 'clinics', 'stores', 'services'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'reviewer_name_en' => 'required|string|max:255',
            'reviewer_name_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'reviewer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'reviewable_type' => 'required|string|in:clinic,store,service',
            'reviewable_id' => 'required|integer',
            'is_approved' => 'boolean',
        ]);

        $reviewerImagePath = $review->reviewer_image;
        if ($request->hasFile('reviewer_image')) {
            if ($review->reviewer_image) {
                Storage::disk('public')->delete($review->reviewer_image);
            }
            $reviewerImagePath = $request->file('reviewer_image')->store('reviews', 'public');
        }

        // Determine the reviewable model class
        $reviewableClass = match ($request->reviewable_type) {
            'clinic' => Clinic::class,
            'store' => Store::class,
            'service' => Service::class,
        };

        $review->update([
            'reviewer_name' => json_encode([
                'en' => $request->reviewer_name_en,
                'ar' => $request->reviewer_name_ar,
            ]),
            'content' => json_encode([
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ]),
            'rating' => $request->rating,
            'reviewer_image' => $reviewerImagePath,
            'date' => $request->date,
            'reviewable_type' => $reviewableClass,
            'reviewable_id' => $request->reviewable_id,
            'is_approved' => $request->is_approved ?? true,
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        if ($review->reviewer_image) {
            Storage::disk('public')->delete($review->reviewer_image);
        }
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }
}
