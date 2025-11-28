<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = Clinic::all();
        return view('admin.clinics.index', compact('clinics'));
    }

    public function create()
    {
        return view('admin.clinics.create');
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
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('clinics', 'public');
        }

        Clinic::create([
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
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.clinics.index')->with('success', 'Clinic created successfully.');
    }

    public function edit(Clinic $clinic)
    {
        return view('admin.clinics.edit', compact('clinic'));
    }

    public function update(Request $request, Clinic $clinic)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'location_en' => 'required|string|max:255',
            'location_ar' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'working_hours_en' => 'required|string|max:255',
            'working_hours_ar' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $clinic->image;
        if ($request->hasFile('image')) {
            if ($clinic->image) {
                Storage::disk('public')->delete($clinic->image);
            }
            $imagePath = $request->file('image')->store('clinics', 'public');
        }

        $clinic->update([
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
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.clinics.index')->with('success', 'Clinic updated successfully.');
    }

    public function destroy(Clinic $clinic)
    {
        if ($clinic->image) {
            Storage::disk('public')->delete($clinic->image);
        }
        $clinic->delete();

        return redirect()->route('admin.clinics.index')->with('success', 'Clinic deleted successfully.');
    }
}
