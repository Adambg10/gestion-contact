<?php

namespace Modules\Ladmin\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Modules\Ladmin\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // ladmin()->allows(['ladmin.contact.create']);

        $userId = $request->user_id;
        $user = null;
        
        if ($userId) {
            $user = User::findOrFail($userId);
        }

        return ladmin()->view('contacts.create', compact('user'));
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ladmin()->allows(['ladmin.contact.create']);

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
            'note' => 'nullable|string',
            'categorie' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Contact::create($request->all());

        return redirect()->route('ladmin.user.edit', $request->user_id)
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Show the form for editing the specified contact.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        // ladmin()->allows(['ladmin.contact.edit']);

        return ladmin()->view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        // ladmin()->allows(['ladmin.contact.edit']);

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
            'note' => 'nullable|string',
            'categorie' => 'nullable|string',
        ]);

        $contact->update($request->all());

        return redirect()->route('ladmin.user.edit', $contact->user_id)
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified contact from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        // ladmin()->allows(['ladmin.contact.delete']);

        $userId = $contact->user_id;
        $contact->delete();

        return redirect()->route('ladmin.user.edit', $userId)
            ->with('success', 'Contact deleted successfully.');
    }
}
