<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cataloguepc extends Model
{
    use HasFactory;
    protected $fillable = [
        'direction',
        'marque_mat',
        'model_mat',
        'processeur_mat',
        'ram_mat',
        'stockage_mat',
        'os_mat',
    ];
}
