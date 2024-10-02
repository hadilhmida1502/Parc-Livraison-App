<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'commande_id','mission_id','produit_test','prix_test','quantité_test','total_test','Gtotal_test'
    ];
}
