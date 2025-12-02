<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // In a real application, you would send an email here
        // For now, we'll just flash a success message

        // Example email sending (commented out):
        // Mail::send('emails.contact', $validated, function($message) use ($validated) {
        //     $message->to('info@brivorakids.com')
        //             ->subject('Contact Form: ' . $validated['subject'])
        //             ->from($validated['email'], $validated['name']);
        // });

        // Flash success message
        return redirect()->route('contact.index')->with('success', 'Thank you for contacting us! We\'ll get back to you soon. 📧');
    }
}
