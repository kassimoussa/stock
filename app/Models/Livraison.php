<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nom_intervenant',
        'nom_demandeur',
        'direction',
        'service',
        'fiche',
        'numero_fiche',
        'date_livraison',
        'sign_chef',
    ];
}
