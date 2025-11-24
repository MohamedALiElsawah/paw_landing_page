<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\Store;
use App\Models\PetPost;
use App\Models\Review;
use App\Models\Partner;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'clinics' => Clinic::count(),
            'stores' => Store::count(),
            'petPosts' => PetPost::count(),
            'reviews' => Review::count(),
            'partners' => Partner::count(),
            'contactSubmissions' => ContactSubmission::where('is_read', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
