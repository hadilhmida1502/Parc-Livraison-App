<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricule','marque',
        'type_vehicle',
        'poids','carburant',
        'mise_en_circulation','kilometrage',
        'etat_vehicle'
    ];
}
