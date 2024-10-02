<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_conducteur','etat_conducteur',
        'date_naissance_conducteur','date_embauche_conducteur',
        'type_permis','num_permis_conducteur',
        'ville_conducteur','code_postal_conducteur',
        'email_conducteur','tel_conducteur',
        'avatar_conducteur'
    ];
}
