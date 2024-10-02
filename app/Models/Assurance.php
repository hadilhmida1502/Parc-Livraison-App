<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_ass','exp_ass','rappel_ass','vehicule',
        'date_taxe','exp_taxe','rappel_taxe',
        'der_vt','proch_vt','rappel_vt'
    ];
}
