<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mission;
use App\Models\Vehicle;
use App\Models\Commande;
use App\Models\Conducteur;
use App\Models\Prog_entretien;

class DashboardController extends Controller
{
    public function index()
    {
        $véhicules = Vehicle::count();
        $users = User::count();
        $conducteurs = Conducteur::count();
        $entretiens = Prog_entretien::count();
        $commandes = Commande::count();
        $missions = Mission::count();
        return view('pages.dashboard', compact('véhicules','users','conducteurs','entretiens','commandes','missions',));
    }
}
