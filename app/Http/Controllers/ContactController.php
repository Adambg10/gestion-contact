<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->contacts();
        
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nom', 'like', '%' . $searchTerm . '%')
                  ->orWhere('prenom', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }
        
        $contacts = $query->get();
        return view('contacts.index', compact('contacts'));
    }

    // CREATE - Afficher le formulaire de création
    public function create()
    {
        return view('contacts.create');
    }

    // CREATE - Sauvegarder le nouveau contact
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        Auth::user()->contacts()->create($request->all());

        return redirect()->route('contacts.index')
                        ->with('success', 'Contact créé avec succès.');
    }

    // READ - Afficher un contact spécifique
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    // UPDATE - Afficher le formulaire d'édition
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    // UPDATE - Mettre à jour le contact
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.show', $contact)
                        ->with('success', 'Contact mis à jour avec succès.');
    }

    // DELETE - Supprimer le contact
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
                        ->with('success', 'Contact supprimé avec succès.');
    }
}