<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Predefined categories
    const CATEGORIES = [
        'Amis' => 'Amis',
        'Famille' => 'Famille', 
        'Travail' => 'Travail',
        'Professionnel' => 'Professionnel',
        'Personnel' => 'Personnel',
        'Autre' => 'Autre'
    ];

    protected $fillable = [
        'user_id',
        'nom',
        'prenom', 
        'email',
        'telephone',
        'adresse',
        'note',
        'categorie'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}