<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Jobs\SendContactNotificationJob;
use App\Models\Contact;
use App\Models\SiteSetting;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact', [
            'activeNav' => 'contact',
            'settings' => [
                'email' => SiteSetting::getValue('contact_email'),
                'whatsapp' => SiteSetting::getValue('contact_whatsapp'),
                'github' => SiteSetting::getValue('github_url'),
                'linkedin' => SiteSetting::getValue('linkedin_url'),
                'location' => SiteSetting::getValue('location'),
            ],
        ]);
    }

    public function store(ContactRequest $request)
    {
        // Honeypot check
        if ($request->filled('_gotcha')) {
            abort(422);
        }

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        SendContactNotificationJob::dispatch($contact);

        return back()->with('success', __('public.contact.success'));
    }
}
