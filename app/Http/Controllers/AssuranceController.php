<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Assurance;
use Illuminate\Http\Request;
use App\Models\Notifications;

class AssuranceController extends Controller
{
    // set assurance page view
	public function Assurance() {
        $Véhicules = Vehicle::all();
        $Assurances = Assurance::all();
        $NotificationsAssurances = Notifications::all();

		return view('pages.assurance',compact('Véhicules','Assurances','NotificationsAssurances'));
	}

    // handle insert a new assurance ajax request
	public function store_assurance(Request $request) {
		$AssuranceData =['date_ass' => $request->date_assadd, 'exp_ass' => $request->exp_assadd, 'rappel_ass' => $request->rappel_assadd, 'vehicule' => $request->vehiculeadd,
                        'date_taxe' => $request->date_taxeadd, 'exp_taxe' => $request->exp_taxeadd, 'rappel_taxe' => $request->rappel_taxeadd,
                        'der_vt' => $request->der_vtadd, 'proch_vt' => $request->proch_vtadd, 'rappel_vt' => $request->rappel_vtadd
                        ];
		Assurance::create($AssuranceData);
		return back();
	}

    // handle edit an assurance ajax request
	public function edit_assurance(Request $request) {
		$id = $request->id;
		$Assurance = Assurance::find($id);
		return response()->json($Assurance);
	}

    // handle update an assurance ajax request
	public function update_assurance(Request $request) {
        $Assurance = Assurance::find($request->ass_id);
        $AssuranceData =['date_ass' => $request->date_ass, 'exp_ass' => $request->exp_ass, 'rappel_ass' => $request->rappel_ass, 'vehicule' => $request->vehicule,
                        'date_taxe' => $request->date_taxe, 'exp_taxe' => $request->exp_taxe, 'rappel_taxe' => $request->rappel_taxe,
                        'der_vt' => $request->der_vt, 'proch_vt' => $request->proch_vt, 'rappel_vt' => $request->rappel_vt
                        ];
		$Assurance->update($AssuranceData);
		return back();
	}

    // handle delete an assurance ajax request
	public function delete_assurance(Request $request) {
		$id = $request->id;
        Assurance::destroy($id);
    }
}
