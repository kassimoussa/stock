<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_devis',
        'fiche_intervention',
        'fournisseur',
        'path',
        'file_name'
    ];
}
