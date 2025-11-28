<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'secondary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'button_text_en' => 'nullable|string|max:255',
            'button_text_ar' => 'nullable|string|max:255',
            'button_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $bannerData = [
            'title_en' => $validated['title_en'],
            'title_ar' => $validated['title_ar'],
            'description_en' => $validated['description_en'],
            'description_ar' => $validated['description_ar'],
            'button_text_en' => $validated['button_text_en'],
            'button_text_ar' => $validated['button_text_ar'],
            'button_url' => $validated['button_url'],
            'order' => $validated['order'] ?? 0,
            'is_active' => $validated['is_active'] ?? true
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $bannerData['image_url'] = $request->file('image')->store('banners', 'public');
        }

        if ($request->hasFile('secondary_image')) {
            $bannerData['secondary_image_url'] = $request->file('secondary_image')->store('banners', 'public');
        }

        Banner::create($bannerData);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);

        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'secondary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'button_text_en' => 'nullable|string|max:255',
            'button_text_ar' => 'nullable|string|max:255',
            'button_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $bannerData = [
            'title_en' => $validated['title_en'],
            'title_ar' => $validated['title_ar'],
            'description_en' => $validated['description_en'],
            'description_ar' => $validated['description_ar'],
            'button_text_en' => $validated['button_text_en'],
            'button_text_ar' => $validated['button_text_ar'],
            'button_url' => $validated['button_url'],
            'order' => $validated['order'] ?? $banner->order,
            'is_active' => $validated['is_active'] ?? $banner->is_active
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($banner->image_url && Storage::disk('public')->exists($banner->image_url)) {
                Storage::disk('public')->delete($banner->image_url);
            }

            $bannerData['image_url'] = $request->file('image')->store('banners', 'public');
        }

        if ($request->hasFile('secondary_image')) {
            if ($banner->secondary_image_url && Storage::disk('public')->exists($banner->secondary_image_url)) {
                Storage::disk('public')->delete($banner->secondary_image_url);
            }

            $bannerData['secondary_image_url'] = $request->file('secondary_image')->store('banners', 'public');
        }

        $banner->update($bannerData);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);

        // Delete image if exists
        if ($banner->image_url && Storage::disk('public')->exists($banner->image_url)) {
            Storage::disk('public')->delete($banner->image_url);
        }

        if ($banner->secondary_image_url && Storage::disk('public')->exists($banner->secondary_image_url)) {
            Storage::disk('public')->delete($banner->secondary_image_url);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully!');
    }

    /**
     * Toggle banner active status
     */
    public function toggleStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['is_active' => !$banner->is_active]);

        return back()->with('success', 'Banner status updated successfully!');
    }
}
