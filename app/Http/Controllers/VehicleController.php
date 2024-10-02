<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // set vehicle page view
	public function vehicle() {
        $Vehicles = Vehicle::all();
        $Missions = Mission::all();
		return view('pages.vehicle',compact('Vehicles','Missions'));
	}

	// handle insert a new vehicle ajax request
	public function store_Vehicle(Request $request) {
		$VehicleData = ['matricule' => $request->matriculeadd, 'marque' => $request->marqueadd,
                    'type_vehicle' => $request->type_vehicleadd,
                    'poids' => $request->poidsadd, 'carburant' => $request->carburantadd,
                    'mise_en_circulation' => $request->mise_en_circulationadd, 'kilometrage' => $request->kilometrageadd,
                    'etat_vehicle' => $request->etat_vehicleadd
                    ];

		Vehicle::create($VehicleData);
		return back();
	}

	// handle edit an vehicle ajax request
	public function edit_Vehicle(Request $request) {
		$id = $request->id;
		$Vehicle = Vehicle::find($id);
		return response()->json($Vehicle);
	}

	// handle update an vehicle ajax request
	public function update_Vehicle(Request $request) {
        $Vehicle = Vehicle::find($request->veh_id);

        $VehicleData = ['matricule' => $request->matricule, 'marque' => $request->marque,
                    'type_vehicle' => $request->type_vehicle,
                    'poids' => $request->poids, 'carburant' => $request->carburant,
                    'mise_en_circulation' => $request->mise_en_circulation, 'kilometrage' => $request->kilometrage,
                    'etat_vehicle' => $request->etat_vehicle
                    ];

		$Vehicle->update($VehicleData);
		return back();
	}

	// handle delete an vehicle ajax request
	public function delete_Vehicle(Request $request) {
		$id = $request->id;
        Vehicle::destroy($id);
    }
}
