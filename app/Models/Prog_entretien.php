<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prog_entretien extends Model
{
    use HasFactory;
    protected $fillable = [
        'immatriculation','type_entretien',
        'Prepete_number','Prappel_number','km_ent','status_prog'
    ];
}
