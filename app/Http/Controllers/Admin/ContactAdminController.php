<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('user');
        
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nom', 'like', '%' . $searchTerm . '%')
                ->orWhere('prenom', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('user', function($userQuery) use ($searchTerm) {
                    $userQuery->where('name', 'like', '%' . $searchTerm . '%');
                });
            });
        }
        
        $contacts = $query->paginate(15);
        $totalContacts = Contact::count();
        $totalUsers = User::count();
        
        return view('admin.contacts.index', compact('contacts', 'totalContacts', 'totalUsers'));
    }

    public function show(Contact $contact)
    {
        $contact->load('user');
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $userName = $contact->user->name;
        $contactName = $contact->prenom . ' ' . $contact->nom;
        
        $contact->delete();

        return redirect()->route('admin.contacts.index')
                        ->with('success', "Contact {$contactName} de {$userName} supprimé avec succès.");
    }

    public function stats()
    {
        $stats = [
            'total_contacts' => Contact::count(),
            'total_users' => User::count(),
            'contacts_this_month' => Contact::whereMonth('created_at', now()->month)->count(),
            'recent_contacts' => Contact::with('user')->latest()->take(10)->get(),
            'users_with_most_contacts' => User::withCount('contacts')
                ->orderBy('contacts_count', 'desc')
                ->take(5)
                ->get()
        ];
        
        return view('admin.stats', compact('stats'));
    }
}
