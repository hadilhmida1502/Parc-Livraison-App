<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use App\Models\Mission;
use App\Models\Vehicle;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $véhicules = Vehicle::count();
        $conducteurs = Conducteur::count();
        $missions = Mission::count();
        return view('pages.welcome', compact('véhicules','conducteurs','missions',));
    }
}
