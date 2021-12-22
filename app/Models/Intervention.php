<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_intervenant',
        'nom_demandeur',
        'dir_demandeur',
        'service_demandeur',
        'ref_patrimoine',
        'materiel',
        'model',
        'date_acquisition',
        'commentaire',
        'diagnostique',
        'suggestion',
        'avis',
        'date_intervention',
        'date_sih',
        'date_din',
        'date_dir',
        'status_sih',
        'status_din',
        'status_dir',
        'submitbyID',
        'status'
    ];
}
