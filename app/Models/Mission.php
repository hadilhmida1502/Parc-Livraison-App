<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_mission','date_mission',
        'debut_mission','fin_mission',
        'veh_mission','cond_mission',
        'ref_cmd','nature_cmd','poids_cmd',
        'destinataire_cmd','tel_dest',
        'email_dest','ville_cmd','adr_cmd',
        'kms','status','idcmd'
    ];
}
