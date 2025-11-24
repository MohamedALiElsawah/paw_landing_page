<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::orderBy('created_at', 'desc')->get();
        return view('admin.contactsubmissions.index', compact('submissions'));
    }

    public function show(ContactSubmission $contactsubmission)
    {
        return view('admin.contactsubmissions.show', compact('contactsubmission'));
    }

    public function destroy(ContactSubmission $contactsubmission)
    {
        $contactsubmission->delete();
        return redirect()->route('admin.contactsubmissions.index')->with('success', 'Contact submission deleted successfully.');
    }

    public function markAsRead(ContactSubmission $contactsubmission)
    {
        $contactsubmission->update(['is_read' => true]);
        return redirect()->route('admin.contactsubmissions.index')->with('success', 'Submission marked as read.');
    }

    public function markAsUnread(ContactSubmission $contactsubmission)
    {
        $contactsubmission->update(['is_read' => false]);
        return redirect()->route('admin.contactsubmissions.index')->with('success', 'Submission marked as unread.');
    }
}
