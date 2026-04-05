<?php 
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Auth::user()->contacts();
        
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nom', 'like', '%' . $searchTerm . '%')
                ->orWhere('prenom', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', $searchTerm . '%@%'); 
            });
        }
        
        $contacts = $query->get();
        return view('contacts.index', compact('contacts'));
    }

    // CREATE - Afficher le formulaire de création
    public function create(Request $request)
    {
        $prefilledUserId = $request->user_id;
        return view('contacts.create', compact('prefilledUserId'));
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
            'categorie' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // If user_id is provided, use it; otherwise use the authenticated user
        $userId = $request->user_id ?? Auth::id();
        
        $contactData = $request->except('user_id');
        $contactData['user_id'] = $userId;
        
        $contact = Contact::create($contactData);

        // Redirect based on where the request came from
        if ($request->user_id) {
            return redirect()->route('ladmin.user.edit', $request->user_id)
                            ->with('success', 'Contact créé avec succès pour cet utilisateur.');
        }

        return redirect()->route('contacts.show', $contact)
                        ->with('success', 'Contact créé avec succès.');
    }

    // READ - Afficher un contact spécifique
    public function show(Contact $contact)
    {
        // Check if user owns this contact or is admin
        if ($contact->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé.');
        }
        
        return view('contacts.show', compact('contact'));
    }

    // UPDATE - Afficher le formulaire d'édition
    public function edit(Contact $contact)
    {
        // Check if user owns this contact or is admin
        if ($contact->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé.');
        }
        
        return view('contacts.edit', compact('contact'));
    }

    // UPDATE - Mettre à jour le contact
    public function update(Request $request, Contact $contact)
    {
        // Check if user owns this contact or is admin
        if ($contact->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé.');
        }
        
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

        return redirect()->route('contacts.show', $contact)
                        ->with('success', 'Contact mis à jour avec succès.');
    }

    // DELETE - Supprimer le contact
    public function destroy(Contact $contact)
    {
        // Check if user owns this contact or is admin
        if ($contact->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé.');
        }
        
        $contact->delete();

        return redirect()->route('contacts.index')
                        ->with('success', 'Contact supprimé avec succès.');
    }

    // EXPORT PDF - Exporter le contact en PDF
    public function exportPdf(Contact $contact)
    {
        // Check if user owns this contact or is admin
        if ($contact->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé.');
        }

        $pdf = Pdf::loadView('contacts.pdf', compact('contact'));
        
        // Générer le nom du fichier
        $filename = 'contact_' . $contact->prenom . '_' . $contact->nom . '_' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }
}