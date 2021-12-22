<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiels_acquis extends Model
{
    use HasFactory;
    protected $fillable = [
        'fiche_acquisition',
        'nom_mat',
        'description_mat',
        'marque_mat',
        'processeur_mat',
        'ram_mat',
        'stockage_mat',
        'quantite',
        'os_mat',
    ];
}
