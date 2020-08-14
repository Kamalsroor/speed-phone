<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::find(1);
        return view('admin.contact.index', compact('contacts'));
    }

    public function update(Request $request, Contact $contact)
    {
        $patterns = [
            'phone' => "/^\+?\d{10,14}$/", 
        ];
        $rules = [
            'address_en' => 'required|string|max:190',
            'address_ar' => 'required|string|max:190',
            'phone1' => 'required|regex:' . $patterns['phone'],
            'fax' => 'required|regex:' . $patterns['phone'],
            'email' => 'required|email|max:150',
            'facebook' => 'required|url|max:150',
            'twitter' => 'required|url|max:150',
            'google' => 'required|url|max:150',
            'instagram' => 'required|url|max:150',
            'linkedIn' => 'required|url|max:150',
        ];
        // dd($request->all(), $rules);
        $this->validate(request(), $rules, [
            'url' => 'The :attribute url is invalid.',
            'fax.regex' => 'The :attribute number is invalid.',
            'phone1.regex' => 'The :attribute number is invalid.',
        ]);
        $contact->update($request->except(['_token', '_method']));
        return back()->with('success', 'Contacts has been updated successfully');
    }
}
