<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission.
     */
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'userType' => 'required|string',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // TODO: Process the form submission (send email, save to database, etc.)
        
        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
