<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acquisition extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nom_demandeur',
        'dir_demandeur',
        'service_demandeur',
        'nom_mat',
        'quantite',
        'description_mat',
        'marque_mat',
        'processeur_mat',
        'ram_mat',
        'stockage_mat',
        'os_mat',
        'date_submit',
        'status_sih',
        'status_dir',
        'status_dsi',
        'date_sih',
        'date_dir',
        'date_dsi',
        'recu',
        'livre',
        'fiche_intervention',
        'status',
        'num_demande',
        'submitbyID',

    ];
}
