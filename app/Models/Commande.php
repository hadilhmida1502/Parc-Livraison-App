<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'réf_cmd','nature',
        'poids_cmnd','destinataire',
        'tél_dest','mail_dest',
        'ville_cmnd','adr_cmnd',
        'status_cmd'
    ];
}
