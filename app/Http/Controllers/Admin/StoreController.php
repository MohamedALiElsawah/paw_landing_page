<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'location_en' => 'required|string|max:255',
            'location_ar' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'working_hours_en' => 'required|string|max:255',
            'working_hours_ar' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stores', 'public');
        }

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('stores/logos', 'public');
        }

        Store::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'location' => [
                'en' => $request->location_en,
                'ar' => $request->location_ar,
            ],
            'phone' => $request->phone,
            'working_hours' => [
                'en' => $request->working_hours_en,
                'ar' => $request->working_hours_ar,
            ],
            'rating' => $request->rating ?? 0,
            'image' => $imagePath,
            'logo' => $logoPath,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.stores.index')->with('success', 'Store created successfully.');
    }

    public function edit(Store $store)
    {
        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'location_en' => 'required|string|max:255',
            'location_ar' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'working_hours_en' => 'required|string|max:255',
            'working_hours_ar' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $imagePath = $store->image;
        if ($request->hasFile('image')) {
            if ($store->image) {
                Storage::disk('public')->delete($store->image);
            }
            $imagePath = $request->file('image')->store('stores', 'public');
        }

        $logoPath = $store->logo;
        if ($request->hasFile('logo')) {
            if ($store->logo) {
                Storage::disk('public')->delete($store->logo);
            }
            $logoPath = $request->file('logo')->store('stores/logos', 'public');
        }

        $store->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'location' => [
                'en' => $request->location_en,
                'ar' => $request->location_ar,
            ],
            'phone' => $request->phone,
            'working_hours' => [
                'en' => $request->working_hours_en,
                'ar' => $request->working_hours_ar,
            ],
            'rating' => $request->rating ?? 0,
            'image' => $imagePath,
            'logo' => $logoPath,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.stores.index')->with('success', 'Store updated successfully.');
    }

    public function destroy(Store $store)
    {
        if ($store->image) {
            Storage::disk('public')->delete($store->image);
        }
        if ($store->logo) {
            Storage::disk('public')->delete($store->logo);
        }
        $store->delete();

        return redirect()->route('admin.stores.index')->with('success', 'Store deleted successfully.');
    }
}
