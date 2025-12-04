<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    //Show the contact form.

    public function index()
    {
        return view('contact');
    }


    //Handle the contact form submission.

    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Save the message to the database
        ContactMessage::create([
            'user_id' => Auth::id(), // Will be null if guest, or user ID if logged in
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'new', // Default status
        ]);

        // Flash success message
        return redirect()->route('contact.index')->with('success', 'Thank you for contacting us! We\'ll get back to you soon.');
    }
}
