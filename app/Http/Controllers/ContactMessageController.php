<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{

    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('home.contact', compact('messages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            'accepted_terms' => 'required',
        ]);

        // نحول 'on' إلى 1 بشكل يدوي
        $data['accepted_terms'] = $request->has('accepted_terms') ? 1 : 0;

        ContactMessage::create($data);

        return back()->with('success', 'تم إرسال الرسالة بنجاح!');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $contact = ContactMessage::findOrFail($id);

        // Send email
//        Mail::raw($request->message, function ($message) use ($contact) {
//            $message->to($contact->email)
//                ->subject('Reply to your message');
//        });

        return back()->with('success', 'تم إرسال الرد بنجاح إلى البريد الإلكتروني.');
    }


}
