<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PetPostController extends Controller
{
    public function index()
    {
        $posts = PetPost::all();
        return view('admin.petposts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.petposts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('petposts', 'public');
        }

        PetPost::create([
            'title' => json_encode([
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ]),
            'content' => json_encode([
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ]),
            'image' => $imagePath,
            'slug' => Str::slug($request->title_en),
            'is_published' => $request->is_published ?? false,
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('admin.petposts.index')->with('success', 'Pet post created successfully.');
    }

    public function edit(PetPost $petpost)
    {
        return view('admin.petposts.edit', compact('petpost'));
    }

    public function update(Request $request, PetPost $petpost)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $petpost->image;
        if ($request->hasFile('image')) {
            if ($petpost->image) {
                Storage::disk('public')->delete($petpost->image);
            }
            $imagePath = $request->file('image')->store('petposts', 'public');
        }

        $petpost->update([
            'title' => json_encode([
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ]),
            'content' => json_encode([
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ]),
            'image' => $imagePath,
            'slug' => Str::slug($request->title_en),
            'is_published' => $request->is_published ?? false,
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('admin.petposts.index')->with('success', 'Pet post updated successfully.');
    }

    public function destroy(PetPost $petpost)
    {
        if ($petpost->image) {
            Storage::disk('public')->delete($petpost->image);
        }
        $petpost->delete();

        return redirect()->route('admin.petposts.index')->with('success', 'Pet post deleted successfully.');
    }
}
