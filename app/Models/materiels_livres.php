<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiels_livres extends Model
{
    use HasFactory;
    protected $fillable = [
        'livraison_id',
        'nom_materiel',
        'description_mat',
        'marque_mat',
        'quantite',
        'observation',
    ];
}
